# message
GatewayWork与yii2结合组成分布式消息服务器框架

# 命令
bin文件夹中启动服务命令

1.php start.php start -d 启动所有服务

2.可分别启动所需服务

  php start_register.php start -d 启动注册服务
  
  php start_gateway.php start -d 启动网关服务
  
  php start_businessworker.php start -d 启动业务服务
  
  php start_globaldata.php start -d 启动全局数据服务
