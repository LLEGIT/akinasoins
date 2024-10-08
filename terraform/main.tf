resource "azurerm_resource_group" "ressource_group_akinasoins" {
  name     = "Akinasoins"
  location = "East West"
}

resource "azurerm_mysql_server" "sqlserverterra" {
  name                = "sqlserver"
  resource_group_name = azurerm_resource_group.ressource_group_akinasoins.name
  location            = azurerm_resource_group.ressource_group_akinasoins.location
  version             = "5.7"
  administrator_login = "test"
  administrator_login_password = "testestest123" 
  sku {
    name     = "B_Gen5_1"
    tier     = "Basic"
    capacity = 1
  }
  storage_profile {
    storage_mb = 5120
    backup_retention_days = 7
    geo_redundant_backup_enabled = false
  }
}

resource "azurerm_mysql_database" "akinasoinsBDDterra" {
  name                = "akinasoinsBDD"
  resource_group_name = azurerm_resource_group.ressource_group_akinasoins.name  
  server_name         = azurerm_mysql_server.sqlserverterra.name
  charset             = "utf8"
  collation           = "utf8_general_ci"
}



resource "azurerm_app_service_plan" "app_service_plan" {
  name                = "myAppServicePlan"
  location            = azurerm_resource_group.ressource_group_akinasoins.location
  resource_group_name = azurerm_resource_group.ressource_group_akinasoins.name
  sku {
    tier     = "Basic"
    size     = "B1"
  }
}

resource "azurerm_app_service" "web_app" {
  name                = "Akinasoins"
  location            = azurerm_resource_group.ressource_group_akinasoins.location
  resource_group_name = azurerm_resource_group.ressource_group_akinasoins.name
  app_service_plan_id = azurerm_app_service_plan.app_service_plan.name

  site_config {
    always_on = true
  }
}

