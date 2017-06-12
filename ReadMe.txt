Projekt dzia�aj�cy lokalnie przy u�yciu narz�dzia XAMPP. Dzia�a� na nim serwer MySQL oraz Apache.
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

Dodatkowo u�ywane by�y skrypty php do po��czenia klienta z baz� danych.
Po��czenie zdalne z zewn�trznym IP skutkowa�o brakiem dzia�ania chatu (serwer SignalR), natomiast skrypty oraz dost�p do bazy danych by� mo�liwy.
Prawdopodobne przyczyny z�ego dzia�ania to firewalle dzia�aj�ce na serwerze lub ograniczenia zastosowanie przy po��czeniu od ISP.
Lokalnie na maszynach wirtualnych projekt dzia�a poprawnie.