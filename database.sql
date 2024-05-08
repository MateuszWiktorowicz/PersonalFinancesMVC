CREATE TABLE IF NOT EXISTS expenses(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  expense_category_assigned_to_user_id int(11) UNSIGNED NOT NULL,
  payment_method_assigned_to_user_id int(11) UNSIGNED NOT NULL,
  amount decimal(8,2) NOT NULL DEFAULT 0.00,
  date_of_expense date NOT NULL,
  expense_comment varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS expenses_category_assigned_to_users(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS expenses_category_default(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);

INSERT IGNORE INTO expenses_category_default (id, name) VALUES
(1, 'Food'),
(2, 'Home'),
(3, 'Transport'),
(4, 'Telecomunication'),
(5, 'Healthcare'),
(6, 'Clothes'),
(7, 'Hygiene'),
(8, 'Kids'),
(9, 'Entertainment'),
(10, 'Travels'),
(11, 'Courses'),
(12, 'Books'),
(13, 'Savings'),
(14, 'Retirement'),
(15, 'Repayment of Debts'),
(16, 'Others');

CREATE TABLE IF NOT EXISTS incomes(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  income_category_assigned_to_user_id int(11) UNSIGNED NOT NULL,
  amount decimal(8,2) NOT NULL DEFAULT 0.00,
  date_of_income date NOT NULL,
  income_comment varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS incomes_category_assigned_to_users(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS incomes_category_default(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);


INSERT IGNORE INTO incomes_category_default (id, name) VALUES
(1, 'Salary'),
(2, 'Bank interest'),
(3, 'Allegro sale'),
(4, 'Another');

CREATE TABLE IF NOT EXISTS payment_methods_assigned_to_users(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS payment_methods_default(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY(id)
);


INSERT IGNORE INTO payment_methods_default (id, name) VALUES
(1, 'Cash'),
(2, 'Debit Card'),
(3, 'Credit Card');

CREATE TABLE users(
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(50) NOT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY(email)
);