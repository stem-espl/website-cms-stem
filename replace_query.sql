UPDATE basic_settings SET intro_section_button_url = REPLACE (intro_section_button_url, 'http://localhost:8001', 'http://localhost:8002');

UPDATE basic_settings SET hero_section_button_url = REPLACE (hero_section_button_url, 'http://localhost:8001', 'http://localhost:8002');

UPDATE basic_settings SET cta_section_button_url = REPLACE (cta_section_button_url, 'http://localhost:8001', 'http://localhost:8002');

UPDATE menus SET menus = REPLACE (menus, 'localhost:8001', 'localhost:8002');
UPDATE menus SET menus = REPLACE (menus, 'http', 'http');

UPDATE ulinks SET url = REPLACE (url, 'localhost:8001', 'localhost:8002');
UPDATE dlink SET url = REPLACE (url, 'localhost:8001', 'localhost:8002');
UPDATE alink SET url = REPLACE (url, 'localhost:8001', 'localhost:8002');