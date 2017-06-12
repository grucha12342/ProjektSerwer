Projekt dzia³aj¹cy lokalnie przy u¿yciu narzêdzia XAMPP. Dzia³a³ na nim serwer MySQL oraz Apache.
IP serwera jest to lokalne IP komputera.
W projektcie wykorzystywana jest baza danych o strukturze:
nazwa bazy: chat
nazwa tabeli: users
Struktura tabeli:
	1	idUsersPodstawowy	AUTO_INCREMENT
	2	Name	varchar(45)	
	3	Surname	varchar(45)
	4	Login	varchar(45)
	5	Avatar	varchar(45)
	6	PhoneNumber	varchar(45)
	7	Email	varchar(45)
	8	IsOnline	tinyint(1)
	9	Password	varchar(45)

Dodatkowo u¿ywane by³y skrypty php do po³¹czenia klienta z baz¹ danych.
Po³¹czenie zdalne z zewnêtrznym IP skutkowa³o brakiem dzia³ania chatu (serwer SignalR), natomiast skrypty oraz dostêp do bazy danych by³ mo¿liwy.
Prawdopodobne przyczyny z³ego dzia³ania to firewalle dzia³aj¹ce na serwerze lub ograniczenia zastosowanie przy po³¹czeniu od ISP.
Lokalnie na maszynach wirtualnych projekt dzia³a poprawnie.