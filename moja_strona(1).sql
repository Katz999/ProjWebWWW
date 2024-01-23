-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2024 at 12:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `matka` int(11) DEFAULT 0,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `matka`, `nazwa`) VALUES
(13, 0, 'Elektronika'),
(15, 14, 'Telewizory'),
(16, 14, 'Akcesoria'),
(17, 13, 'Komputery i akcesoria'),
(18, 13, 'Telefony i akcesoria'),
(19, 0, 'Dom i ogród'),
(20, 19, 'Meble'),
(25, 20, 'Meble do salonu'),
(26, 20, 'Meble ogrodowe'),
(27, 17, 'Komputery');

-- --------------------------------------------------------

--
-- Table structure for table `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Strona główna', '<div style=\"text-align: center;\"><h1>Historia Linuxa</h1></div>\r\n	<img src=\"./img/TuxFlat.svg.png\" width=\"200\" height=\"200\"  id=\"leftim\">\r\n	<h2>Linux – rodzina uniksopodobnych systemów operacyjnych opartych na jądrze Linux. Linux jest jednym z przykładów wolnego i otwartego oprogramowania (FLOSS): jego kod źródłowy może być dowolnie wykorzystywany, modyfikowany i rozpowszechniany. Od kwietnia 2017 roku Android (z zaadaptowanym jądrem Linuxa) oficjalnie jest najpopularniejszym systemem operacyjnym na świecie. </h2>\r\n	<img src=\"./img/server.jpg\" width=\"200\" height=\"200\"  id=\"rightim\">\r\n	<h3>Jednym z zastosowań Linuksa są środowiska serwerowe, dla których komercyjne wsparcie oferują firmy komputerowe, jak IBM, Oracle, Dell, Microsoft, Hewlett-Packard, Red Hat i Novell. Linux instalowany jest na różnorodnym sprzęcie komputerowym, np. komputerach biurkowych, superkomputerach i systemach wbudowanych, jak telefony komórkowe, routery oraz telewizory (np. LG, Samsung).  </h3>\r\n	\r\n\r\n<div id=\"zegarek\"></div>\r\n<div id=\"data\"></div>\r\n', 1),
(2, 'Historia', '<h1>Historia</h1>\r\n<img src=\"./img/Linus_Torvalds.jpeg\" style=\"width: 1vw; min-width: 250px;\" id=\"leftim\">\r\n<p>Historia Linuksa rozpoczęła się w 1991 roku, kiedy to fiński programista, Linus Torvalds poinformował na grupie dyskusyjnej Miniksa o hobbystycznym tworzeniu przez siebie niedużego, wolnego systemu operacyjnego, przeznaczonego dla procesorów z rodzin i386 oraz i486.</p>\r\n<img src=\"./img/linux012.jpg\" width=\"200\" height=\"200\"  id=\"rightim\">\r\n<p>Linus stworzył jednak tylko jądro, pełny system operacyjny potrzebował jeszcze powłoki systemowej, kompilatora, bibliotek itp. W roli większości z tych narzędzi użyto oprogramowania GNU, co jednak w przypadku niektórych komponentów systemu wymagało poważnych zmian, niekiedy finansowanych przez Projekt GNU, niekiedy dokonanych już wcześniej przez Linusa Torvaldsa.\r\n</p>\r\n<p>Dużo pracy wymagało także zintegrowanie systemu do postaci dystrybucji, które umożliwiały zainstalowanie go w stosunkowo prosty sposób. Jednymi z pierwszych były opublikowany 16 lipca 1993 Slackware Linux czy założony miesiąc później Debian, nazywający siebie GNU/Linux.</p>\r\n \r\n<p>Wraz z rozwojem jądra Linuxa zaczęły pojawiać się różne dystrybucje (również nazywane “distros”), które są niezależnymi od siebie wersjami systemu operacyjnego Linux. Dystrybucje różnią się między sobą pakietami oprogramowania, interfejsem użytkownika oraz menedżerem pakietów. Wśród najbardziej znanych dystrybucji znajdują się Ubuntu, Debian, Fedora, Arch Linux, openSUSE i CentOS.</p>\r\n', 1),
(3, 'Kontakt', '    <?php\r\n    $nameErr = $emailErr = $messageErr = \"\";\r\n    $name = $email = $message = \"\";\r\n\r\n    if ($_SERVER[\"REQUEST_METHOD\"] == \"POST\") {\r\n        if (empty($_POST[\"name\"])) {\r\n            $nameErr = \"Imię jest wymagane\";\r\n        } else {\r\n            $name = test_input($_POST[\"name\"]);\r\n        }\r\n\r\n        if (empty($_POST[\"email\"])) {\r\n            $emailErr = \"Email jest wymagany\";\r\n        } else {\r\n            $email = test_input($_POST[\"email\"]);\r\n            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {\r\n                $emailErr = \"Nieprawidłowy format e-mail\";\r\n            }\r\n        }\r\n\r\n        if (empty($_POST[\"message\"])) {\r\n            $messageErr = \"Treść wiadomości jest wymagana\";\r\n        } else {\r\n            $message = test_input($_POST[\"message\"]);\r\n        }\r\n\r\n        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {\r\n            $to = \"164446@student.uwm.edu.pl\";\r\n            $subject = \"Pusty temat\";\r\n            $headers = \"From: $email\";\r\n\r\n            mail($to, $subject, $message, $headers);\r\n        }\r\n    }\r\n\r\n    function test_input($data) {\r\n        $data = trim($data);\r\n        $data = stripslashes($data);\r\n        $data = htmlspecialchars($data);\r\n        return $data;\r\n    }\r\n    ?>\r\n\r\n    <h2>Kontakt</h2>\r\n\r\n    <form action=\"<?php echo htmlspecialchars($_SERVER[\"PHP_SELF\"]); ?>\" method=\"post\">\r\n        <label for=\"name\">imie:</label>\r\n        <input type=\"text\" id=\"name\" name=\"name\" value=\"<?php echo $name; ?>\" required>\r\n        <span class=\"error\"><?php echo $nameErr; ?></span>\r\n\r\n        <label for=\"email\">E-mail:</label>\r\n        <input type=\"email\" id=\"email\" name=\"email\" value=\"<?php echo $email; ?>\" required>\r\n        <span class=\"error\"><?php echo $emailErr; ?></span>\r\n\r\n        <label for=\"message\">Wiadomość:</label>\r\n        <textarea id=\"message\" name=\"message\" rows=\"4\" required><?php echo $message; ?></textarea>\r\n        <span class=\"error\"><?php echo $messageErr; ?></span>\r\n\r\n        <input type=\"submit\" value=\"Wyślij\">\r\n    </form>\r\n', 1),
(4, 'porównanie', '    <b>1. Model licencjonowania:</b>\r\n\r\n       <p> Linux: Jest wolnym i otwartoźródłowym systemem operacyjnym, co oznacza, że kod źródłowy jest dostępny publicznie, a użytkownicy mogą go modyfikować i rozprowadzać bez opłat.</p>\r\n\r\n        <p>Windows: Windows jest komercyjnym systemem operacyjnym firmy Microsoft, co oznacza, że użytkownicy muszą płacić zalicencje.</p> \r\n\r\n       <p> macOS: macOS jest dostępne wyłącznie na sprzęcie Apple, a jego zakup jest często wliczany w cenę sprzętu.</p>\r\n\r\n    <b>2. Interfejs użytkownika:</b>\r\n<img src=\"./img/gnome.webp\" width=\"240\" height=\"140\"  id=\"rightim\">\r\n        <p>Linux: Posiada różnorodne środowiska graficzne, takie jak GNOME, KDE, Xfce itp., co pozwala użytkownikom dostosować wygląd i zachowanie systemu według swoich preferencji.</p>\r\n<img src=\"./img/Wondows-11-Start.jpg\" width=\"240\" height=\"140\"  id=\"leftim\">\r\n       <p> Windows: Windows ma spójny interfejs użytkownika (np. Windows 10 i 11 mają podobny interfejs), ale użytkownicy mają pewną kontrolę nad dostosowywaniem wyglądu.</p>\r\n<img src=\"./img/macos.jpg\" width=\"240\" height=\"140\"  id=\"rightim\">\r\n       <p> macOS: macOS jest znane z eleganckiego i spójnego interfejsu użytkownika, który jest specyficzny dla sprzętu Apple.</p>\r\n\r\n    <b>3. Dostępność oprogramowania:</b>\r\n\r\n       <p> Linux: Linux posiada ogromną ilość oprogramowania dostępnego za darmo z repozytoriów. Jednak niektóre aplikacje dostępne na Windows i macOS mogą nie być dostępne na Linuxie.</p>\r\n\r\n        <p>Windows: Windows ma ogromny rynek oprogramowania, w tym wiele komercyjnych aplikacji i gier. Jest to platforma dominująca w grach na PC.</p>\r\n\r\n        <p>macOS: macOS ma dostęp do wielu aplikacji, w tym tych z Mac App Store i aplikacji kompatybilnych z systemem Unix.</p>\r\n\r\n    <b>4. Stabilność i bezpieczeństwo:</b>\r\n\r\n       <p> Linux: Jest znany ze stabilności i bezpieczeństwa, zwłaszcza w serwerowych zastosowaniach. Aktualizacje są często dostępne, co pomaga w utrzymaniu bezpieczeństwa.</p>\r\n\r\n       <p> Windows: Windows jest bardziej narażony na ataki złośliwego oprogramowania i wymaga regularnych aktualizacji zabezpieczeń.</p>\r\n\r\n        <p>macOS: macOS jest również stosunkowo stabilnym i bezpiecznym systemem operacyjnym, ale nie jest całkowicie odporny na zagrożenia.</p>\r\n\r\n    <b>5. Wsparcie sprzętowe:</b>\r\n\r\n        <p>Linux: Działa na wielu różnych platformach i architekturach, ale wsparcie sprzętowe może być zróżnicowane w zależności od dystrybucji.</p>\r\n\r\n        <p>Windows: Windows jest dostosowany do wielu rodzajów sprzętu i ma szerokie wsparcie dla różnych urządzeń.</p>\r\n\r\n        <p>macOS: macOS działa tylko na sprzęcie Apple, co zapewnia doskonałe wsparcie sprzętowe, ale ogranicza wybór sprzętu.</p>\r\n\r\n    <b>6. Społeczność i wsparcie:</b>\r\n\r\n       <p> Linux: Ma silną społeczność użytkowników i deweloperów, co oznacza, że można znaleźć wiele źródeł wsparcia online.</p>\r\n\r\n       <p> Windows: Microsoft oferuje oficjalne wsparcie techniczne dla systemu Windows, a także wiele forów i witryn z informacjami na temat rozwiązywania problemów.</p>\r\n\r\n        <p>macOS: Apple oferuje wsparcie techniczne dla użytkowników, a także posiada aktywną społeczność użytkowników.</p>\r\n\r\n', 1),
(5, 'ciekawostki', '<h1>Ciekawostki o Linuxie</h1>\r\n<p>Dzięki swoim zasługom, od jego nazwiska nazwano jedną z asteroid - 979. Torvalds.</p>\r\n\r\n<p>Nie do końca wiadomo, skąd wzięło się imię oficjalnej maskotki Linuksa, pingwina zwanego Tux. Choć większość osób sugeruje, że ten zabawny nielot wygląda po prostu jakby miał na sobie smoking (po angielsku ”tuxedo”).</p>\r\n\r\n<p>Tux doczekał się projektu własnego pomnika. Monument powstanie w syberyjskim mieście Tiumeń.</p>\r\n\r\n<p>Pierwsza wersja linuksowego jądra liczyła sobie 17. 250 linijek kodu. Ostatnie mają ich około 10 milionów. Dlatego wkład Torvaldsa w obecny kształt kodu wynosi mniej więcej dwa procent.</p>\r\n\r\n<p>Linux jest pisany w języku C.</p>\r\n\r\n<p>Początkowo Linux miał się nazywać Freax, co było połączeniem słów ”freak”. i ”free” oraz litery ”x” wskazującej na pochodzenie od systemu Unix. Jednak przyjaciel Torvaldsa, Ari Lemmke, który był administratorem serwera FTP, na którym przechowywano pierwsze wersje systemu sam nazwał katalog linux. I tak już pozostało.</p>\r\n\r\n<p>System komputerowy działający w wielu samochodach marki Toyota oparty jest właśnie na Linuksie.</p>\r\n\r\n<p> Z 50. najszybszych superkomputerów świata aż 446 (87 proc.) działa na Linuksie. Różnych wersji tego systemu używa też 95 proc. Hollywoodzkich wytwórni filmowych. Pierwszym filmem w całości zrealizowanym na Linuksie był ”Titanic” z roku 1997. Linux używany jest także w systemie japońskich szybkich pociągów, kontroli ruchu samochodowego w regionie San Francisco, na nowojorskiej giełdzie, w CERN-ie, centrach kontroli lotów, przy kontroli reaktorów nuklearnych łodzi podwodnych i tak dalej, i tak dalej… To tyle jeśli chodzi o niezawodność.</p>\r\n\r\n', 1),
(6, 'dystrybucje', '<h1>Dystrybucje linuxa</h1>\r\n<h2>Linux jest głównym składnikiem wielu różnych systemów operacyjnych, często nazywanych \"dystrybucjami Linuxa\" lub po prostu \"dystrybucjami\". Te dystrybucje łączą jądro Linuxa z różnymi pakietami oprogramowania i narzędziami, tworząc kompletny system operacyjny do różnych celów, od hostingu serwera po komputery stacjonarne i systemy wbudowane.</h2>\r\n<p>Niektóre popularne dystrybucje Linuxa to:</p>\r\n<table>\r\n<tr>\r\n<img src=\"./img/Ubuntu.png\" width=\"200\" height=\"200\"  id=\"leftim\">\r\n<p><b>Ubuntu</b>: Przyjazna dla użytkownika dystrybucja znana z łatwości obsługi i częstych aktualizacji. Jest powszechnie stosowana w środowiskach komputerów stacjonarnych i serwerów.</p>\r\n</tr>\r\n<tr>\r\n<img src=\"./img/debian.png\" width=\"200\" height=\"200\"  id=\"rightim\">\r\n<p><b>Debian</b> – projekt wolnej dystrybucji systemu operacyjnego GNU/Linux oraz GNU/kFreeBSD realizowany przez ochotników na całym świecie. Wewnątrz Debiana istnieją również projekty, mające na celu stworzenie dystrybucji systemu GNU/Hurd, inne odmiany BSD, a nawet dystrybucji wolnego oprogramowania na platformę Windows.</p>\r\n\r\n<p>Debian cieszy się opinią stabilnego systemu o wysokiej jakości i łatwego do aktualizacji. Ze względu na dbałość o jakość i bezpieczeństwo dystrybucji, nowe wersje stabilne pojawiają się stosunkowo rzadko, często dochodzi też do opóźnień w ich wydawaniu. </p>\r\n<p>Powstanie Debiana ogłosił 16 sierpnia 1993 r. na grupie comp.os.linux.development Ian Murdock, wówczas student uniwersytetu Purdue. Napisał on Manifest Debiana, w którym apelował o stworzenie otwartej dystrybucji w duchu Linuksa i GNU. Nazwa „Debian” jest zbitką imion Murdocka i jego dziewczyny (obecnie byłej żony) Debry. Dystrybucja ta została zbudowana na podstawie SLS. Wśród założeń Debiana było między innymi to, że będzie zawierał on najbardziej aktualne wersje oprogramowania. </p>\r\n</tr>\r\n<tr>\r\n<img src=\"./img/fedora.png\" width=\"200\" height=\"200\"  id=\"leftim\">\r\n<p><b>Fedora</b> - następca wolnej dystrybucji Red Hat Linux, rozwijany przez Fedora Project i finansowany głównie przez Red Hat. Twórcy Fedory stawiają na innowacyjność, dlatego też kolejne wydania pojawiają się często i zawierają najnowsze dostępne oprogramowanie, nawet jeśli prace nad stabilną wersją nie zostały jeszcze ukończone. Z tego powodu oraz faktu ścisłego powiązania z Red Hatem, często, lecz niesłusznie Fedorę określa się mianem „poligonu Red Hata”. W czerwcu 2005 utworzono Fundację Fedora, mającą w zamierzeniu koordynować prace nad Fedorą w większym stopniu, niezależnie od Red Hata.\r\n</p>\r\n<p>Fedora jest stosowana zarówno jako system operacyjny dla komputerów domowych, jak i serwerów. Nazwa dystrybucji pochodzi od rodzaju kapelusza. </p>\r\n</tr>\r\n<tr>\r\n<img src=\"./img/Arch-linux.png\" width=\"200\" height=\"200\"  id=\"rightim\">\r\n<p><b>Arch Linux</b> – dystrybucja GNU/Linuksa stworzona przez Judda Vineta. Stawia ona sobie za cel łatwość konfiguracji i użytkowania systemu operacyjnego, a także dostępność znacznej ilości aktualnego oprogramowania, którym można w prosty i wygodny sposób zarządzać. Łatwość ta nie jest jednak osiągana przez dużą ilość graficznych konfiguratorów, a poprzez przemyślnie rozmieszczone i zaprojektowane pliki konfiguracyjne, skrypty i programy. Dlatego też Arch Linux, mimo swojej prostoty, może nie być odpowiednim systemem dla osób niemających wcześniej styczności z GNU/Linuksem ani dla tych, dla których używanie konsoli oraz edycja plików tekstowych w celu zmiany ustawień mogą sprawiać problemy.</p> \r\n</tr>\r\n<tr>\r\n<img src=\"./img/rhel.jpg\" width=\"200\" height=\"80\"  id=\"leftim\">\r\n<p><b>RHEL</b> -  skierowany jest przede wszystkim do odbiorców komercyjnych takich jak przedsiębiorcy i firmy, dla których oferuje wsparcie i pomoc techniczną oraz aktualizacje za pomocą Red Hat Network. Od kilku lat Red Hat silnie wspiera również użytkowników indywidualnych (Red Hat Enterprise Linux Desktop i Workstation). </p>\r\n</tr>\r\n<tr>\r\n<img src=\"./img/mint.jpg\" width=\"200\" height=\"200\"  id=\"rightim\">\r\n<p><b>Linux mint</b> - Dystrybucja systemu GNU/Linux oparta na Ubuntu oraz Debianie, skierowana do początkujących użytkowników. Dystrybucja kładzie nacisk na prostotę użytkowania, przydatne aplikacje i pełne ich wsparcie zaraz po instalacji. Twórcy zadbali o dodanie wielu graficznych nakładek. Na standardowej płycie instalacyjnej znajduje się większość popularnego własnościowego oprogramowania - wtyczka Adobe Flash Player, Java oraz duży zbiór kodeków audio i wideo pozwalających odtworzyć wszystkie popularne pliki muzyczne i filmowe, nawet korzystając z wersji Live CD (w Ubuntu takie oprogramowanie trzeba zainstalować samodzielnie). </p>\r\n</tr>\r\n<tr>\r\n<img src=\"./img/kali.jpg\" width=\"200\" height=\"200\"  id=\"leftim\">\r\n<p><b>Kali Linux</b> – dystrybucja systemu operacyjnego Linux typu Live CD bazująca na Debian przeznaczona głównie do łamania zabezpieczeń i testów penetracyjnych czy też audytów bezpieczeństwa[1]. Jest następcą dystrybucji BackTrack</p>\r\n\r\n<p>Zawiera wsparcie dla projektu Metasploit. Zawiera między innymi takie narzędzia jak: Wireshark, John the Ripper, Nmap oraz Aircrack-ng. Kali jest dystrybuowana jako obrazy dla architektur 32- i 64-bitowych procesorów serii x86, a także opartych na architekturze ARM.</p>\r\n</tr>\r\n</table>\r\n\r\n', 1),
(7, 'Filmy', '    <h1>Filmy Youtube o Linuxie</h1>\r\n\r\n    <h2>Video 1</h2>\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/rrB13utjYV4\" frameborder=\"0\" allowfullscreen></iframe>\r\n\r\n    <h2>Video 2</h2>\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/nit5T_BUayY\" frameborder=\"0\" allowfullscreen></iframe>\r\n\r\n    <h2>Video 3</h2>\r\n    <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/42iQKuQodW4\" frameborder=\"0\" allowfullscreen></iframe>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `data_utworzenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_wygasniecia` date DEFAULT NULL,
  `cena_netto` decimal(10,2) DEFAULT NULL,
  `podatek_vat` decimal(5,2) DEFAULT NULL,
  `ilosc_sztuk` int(11) DEFAULT NULL,
  `status_dostepnosci` tinyint(1) DEFAULT NULL,
  `kategoria` varchar(255) DEFAULT NULL,
  `gabaryt_produktu` varchar(255) DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_sztuk`, `status_dostepnosci`, `kategoria`, `gabaryt_produktu`, `zdjecie`) VALUES
(2, 'TV1', 'Telewizor', '2024-01-17 07:55:37', '2024-01-17 07:55:37', '0000-00-00', 1200.00, 23.00, 3, 0, 'Telewizor', 'Duży', 'https://www.shutterstock.com/image-photo/tv-flat-screen-lcd-plasma-260nw-314401364.jpg'),
(4, 'TV5', 'Kolejny telewizor', '2024-01-17 10:06:24', '2024-01-17 10:06:24', '0000-00-00', 3500.00, 23.00, 1, 0, 'Telewizor', 'Duży', 'https://t4.ftcdn.net/jpg/04/32/88/03/360_F_432880347_TbjV84Q15xjfgJLjm7jlS4JBBNQ1dMSw.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) NOT NULL,
  `matka` int(10) NOT NULL DEFAULT 0,
  `nazwa` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
