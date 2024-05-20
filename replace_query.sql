UPDATE basic_settings SET intro_section_button_url = REPLACE (intro_section_button_url, 'http://localhost:8001', 'https://stemwebsite.encureit.com');

UPDATE basic_settings SET hero_section_button_url = REPLACE (hero_section_button_url, 'http://localhost:8001', 'https://stemwebsite.encureit.com');

UPDATE basic_settings SET cta_section_button_url = REPLACE (cta_section_button_url, 'http://localhost:8001', 'https://stemwebsite.encureit.com');

UPDATE menus SET menus = REPLACE (menus, 'localhost:8001', 'stemwebsite.encureit.com');
UPDATE menus SET menus = REPLACE (menus, 'http', 'https');

UPDATE ulinks SET url = REPLACE (url, 'localhost:8001', 'stemwebsite.encureit.com');
UPDATE ulinks SET url = REPLACE (url, 'http', 'https');
UPDATE dlink SET url = REPLACE (url, 'localhost:8001', 'stemwebsite.encureit.com');
UPDATE dlink SET url = REPLACE (url, 'http', 'https');
UPDATE alink SET url = REPLACE (url, 'localhost:8001', 'stemwebsite.encureit.com');
UPDATE alink SET url = REPLACE (url, 'http', 'https');

UPDATE e_governance SET url = REPLACE (url, 'http://localhost:8001', 'https://stemwebsite.encureit.com');
UPDATE members SET url = REPLACE (url, 'http://localhost:8001', 'https://stemwebsite.encureit.com');
UPDATE tenders SET tender_link = REPLACE (tender_link, 'http://localhost:8001', 'https://stemwebsite.encureit.com');