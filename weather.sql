SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `weather` (
                           `id` int(11) NOT NULL,
                           `user_id` int(50) NOT NULL,
                           `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `weather` (`id`, `user_id`, `city`) VALUES
(1, 2, 'Berlin'),
(2, 1, 'Paris');

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `weather`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
