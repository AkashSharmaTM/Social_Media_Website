USE social_network;

INSERT INTO users (username, email, password, thumbnail) VALUES 
('john_doe', 'john@example.com', MD5('password123'), 'user1.png'),
('jane_doe', 'jane@example.com', MD5('password123'), 'user2.png'),
('sam_smith', 'sam@example.com', MD5('password123'), 'user3.png'),
('emma_jones', 'emma@example.com', MD5('password123'), 'user4.png');

INSERT INTO friends (user_id, friend_id) VALUES 
(1, 2),
(1, 3),
(2, 3),
(2, 4);

INSERT INTO messages (sender_id, receiver_id, content) VALUES 
(1, 2, 'Hi Jane!'),
(2, 1, 'Hello John!'),
(3, 1, 'Hey John, how are you?'),
(4, 2, 'Hi Jane, what’s up?');
