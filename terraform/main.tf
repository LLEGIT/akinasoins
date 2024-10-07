resource "azurerm_resource_group" "ressource_group_akinasoins" {
  name     = "Akinasoins"
  location = "East West"
}

resource "azurerm_mysql_server" "sqlserverterra" {
  name                = "sqlserver"
  resource_group_name = azurerm_resource_group.rg.name
  location            = azurerm_resource_group.rg.location
  version             = "5.7"
  administrator_login = "test"
  administrator_login_password = "testestest123"  # Change this to a secure password
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

resource "azurerm_kubernetes_cluster" "aks_appli" {
  name                = "AKSAkinasoins"
  location            = azurerm_resource_group.location_terra.location
  resource_group_name = azurerm_resource_group.ressource_group_akinasoins.name
  dns_prefix          = "myaks"

  agent_pool_profile {
    name            = "agentpool"
    count           = 3
    vm_size        = "Standard_DS2_v2"
    os_type        = "Linux"
  }

  linux_profile {
    admin_username = "azureuser"
    ssh_key {
      key_data = file("~/.ssh/id_rsa.pub")  # Assurez-vous d'avoir une clé SSH générée
    }
  }

  service_principal {
    client_id     = var.client_id  # Remplacez par votre client_id
    client_secret = var.client_secret  # Remplacez par votre client_secret
  }

  role_based_access_control {
    enabled = true
  }
}

resource "random_string" "server_suffix" {
  length  = 8
  special = false
}

output "mysql_server_fqdn" {
  value = azurerm_mysql_server.mysql_server.fully_qualified_domain_name
}

output "aks_cluster_name" {
  value = azurerm_kubernetes_cluster.aks.name
}
