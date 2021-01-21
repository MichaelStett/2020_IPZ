SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
     `id` int(11) NOT NULL,
     `username` varchar(50) NOT NULL,
     `firstName` varchar(255) NOT NULL,
     `lastName` varchar(255) NOT NULL,
     `email` varchar(255) NOT NULL,
     `status` varchar(255) NOT NULL,
     `role` varchar(1) NOT NULL,
     `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`,`role`, `email`, `status`, `password`) VALUES
(1, 'admin', 'adminFirstName', 'adminLastName', 'A', 'admin@mail.com', true,  '21232f297a57a5a743894a0e4a801fc3'),
(2, 'user1', 'user1FirstName', 'user1LastName', 'U', 'user1@mail.com', true,  '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'user2', 'user2FirstName', 'user2LastName', 'U', 'user2@mail.com', false, '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'user3', 'user3FirstName', 'user3LastName', 'U', 'user3@mail.com', false, '5f4dcc3b5aa765d61d8327deb882cf99'),
(5, 'user4', 'user4FirstName', 'user4LastName', 'U', 'user4@mail.com', true,  '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
