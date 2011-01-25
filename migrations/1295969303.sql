CREATE VIEW `accounts_contacts_view` AS
SELECT p.*, a.id AS account_id
FROM accounts AS a
JOIN accounts_contacts AS ac ON ac.account_id = a.id
JOIN people AS p ON ac.person_id = p.id