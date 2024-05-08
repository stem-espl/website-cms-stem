UPDATE menus SET menus = REPLACE (menus, '127.0.0.1', 'localhost');
UPDATE menus SET menus = REPLACE (menus, 'localhost:8002', 'localhost:8001');
UPDATE menus SET menus = REPLACE (menus, 'localhost:8000', 'localhost:8001');
UPDATE menus SET menus = REPLACE (menus, 'https', 'http');

UPDATE ulinks SET url = REPLACE (url, '127.0.0.1', 'localhost');
UPDATE ulinks SET url = REPLACE (url, 'localhost:8002', 'localhost:8001');
UPDATE ulinks SET url = REPLACE (url, 'localhost:8000', 'localhost:8001');
UPDATE ulinks SET url = REPLACE (url, 'https', 'http');

UPDATE alink SET url = REPLACE (url, '127.0.0.1', 'localhost');
UPDATE alink SET url = REPLACE (url, 'localhost:8002', 'localhost:8001');
UPDATE alink SET url = REPLACE (url, 'localhost:8000', 'localhost:8001');
UPDATE alink SET url = REPLACE (url, 'https', 'http');

UPDATE dlink SET url = REPLACE (url, '127.0.0.1', 'localhost');
UPDATE dlink SET url = REPLACE (url, 'localhost:8002', 'localhost:8001');
UPDATE dlink SET url = REPLACE (url, 'localhost:8000', 'localhost:8001');
UPDATE dlink SET url = REPLACE (url, 'https', 'http');

