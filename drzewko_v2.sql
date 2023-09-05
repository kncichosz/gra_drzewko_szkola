-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Wrz 2022, 13:04
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `drzewko_v2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `drzewka`
--

CREATE TABLE `drzewka` (
  `id_drzewka` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `czas_wyrosniecia` datetime NOT NULL,
  `czas_robaczka` datetime DEFAULT NULL,
  `czas_podlania` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `drzewka`
--

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `drzewka`
--
ALTER TABLE `drzewka`
  ADD PRIMARY KEY (`id_drzewka`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `drzewka`
--
ALTER TABLE `drzewka`
  MODIFY `id_drzewka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
