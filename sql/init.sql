CREATE DATABASE IF NOT EXISTS PROTOCOL_DB;

USE PROTOCOL_DB;

CREATE TABLE IF NOT EXISTS PROTOCOL_TABLE (
	protocol_number INT NOT NULL PRIMARY KEY,
  	issue_date DATE NOT NULL,
  	responsible_employee VARCHAR(255) NOT NULL,
  	compliance_flag BOOLEAN NOT NULL
);