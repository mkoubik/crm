CREATE VIEW `accounts_list_view` AS
SELECT a.*, COUNT(c.id) AS contacts_count
FROM accounts AS a
LEFT JOIN accounts_contacts AS ac ON ac.account_id = a.id
LEFT JOIN people AS c ON ac.person_id = c.id
GROUP BY a.id