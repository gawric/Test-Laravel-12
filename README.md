
## Тестовое задание BookingCore

Запуск:  
После миграции предлагаю запустить      
Seeders так как тестов я не писал что-бы можно было проверить работу  
Папка database\seeders  
Файлы1 GuideSeeder.php  
Файлы2 HuntingSeeder.php  
  
Проверка:  
Точки входа  
Можно открыть и даже через Curl но я пробовал через PostMan  
Точкка входа>  
http://127.0.0.1:8000/api/guides  

Пробовал только через PostMan с такими данными:     
header > Content-Type application/json  
		Accept application/json  
body >   
{"tour_name": "Test Hunt","hunter_name": "John Doe","guide_id": 1,"date": "2025-11-10 10:30","participants_count": 3}  
  
Точкка входа>  
http://127.0.0.1:8000/api/bookings  



