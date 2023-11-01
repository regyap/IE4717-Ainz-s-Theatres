-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2023 at 09:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IE4717_ainzs_theatres`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `address`, `image`) VALUES
(1, 'AZT Funan', '107 North Bridge road, #05-01, Funan Mall, Singapore 179105', 'location_funan.jpg'),
(2, 'AZT Vivo', '1 HarbourFront Walk, #02-30, VivoCity, Singapore 098585', 'location_vivo.jpg'),
(3, 'AZT Tiong Bahru Plaza', '302 Tiong Bahru Road, #04-105, Tiong Bahru Plaza, Singapore 168732', 'location_tiongBahru.jpg'),
(4, 'AZT Bugis+', '201 Victoria Street #05-01 Bugis+ Singapore 188067', 'location_bugis.jpg'),
(5, 'AZT Bedok', '445 Bedok North Street 1, #04-01, Djitsun Mall Bedok, Singapore 469661', 'location_bedok.jpg'),
(6, 'AZT Tampines', '4 Tampines Central, #04-17/18, Tampines Mall Shopping Centre, Singapore 529510', 'location_tampines.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `duration` int(4) NOT NULL,
  `viewerDiscretion` varchar(10) NOT NULL,
  `viewerDiscretionDescription` varchar(50) DEFAULT NULL,
  `sypnosis` varchar(2000) NOT NULL,
  `director` varchar(100) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `releaseDate` date NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `image`, `duration`, `viewerDiscretion`, `viewerDiscretionDescription`, `sypnosis`, `director`, `cast`, `releaseDate`, `genre`) VALUES
(1, 'Oppenheimer', 'oppenheimer.webp', 180, 'M18', 'Sexual References', 'During World War II, Lt. Gen. Leslie Groves Jr. appoints physicist J. Robert Oppenheimer to work on the top-secret Manhattan Project. Oppenheimer and a team of scientists spend years developing and designing the atomic bomb. Their work comes to fruition on July 16, 1945, as they witness the world\'s first nuclear explosion, forever changing the course of history.', 'Christopher Nolan', 'Cillian Murphy, Emily Blunt, Matt Damon, Robert Downey Jr., Florence Pugh, Josh Hartnett, Casey Affleck, Rami Malek, Kenneth Branagh, Benny Safdie', '2023-10-26', 'Drama/Thriller'),
(3, 'Five Nights At Freddy\'s', 'fiveNightsAtFreddys.webp', 109, 'PG13', 'Some Violence & Horror', 'The film follows a troubled security guard as he begins working at Freddy Fazbear\'s Pizza. While spending his first night on the job, he realizes the night shift at Freddy\'s won\'t be so easy to make it through.', 'Emma Tammi', 'Josh Hutcherson, Elizabeth Lail, Kat Conner Sterling, Piper Rubio, Mary Stuart Masterson, Matthew Lillard', '2023-10-26', 'Horror/ Thriller'),
(4, 'Creation Of The Gods I: Kingdom Of Storms 封神第一部：朝歌风云', 'creationOfTheGods.jpeg', 148, 'NC16', 'Violence', 'The first installment starts the story with the collusion of villainous King Zhou and his consort fox spirit Su Daji, which causes the wrath of heaven. The mystic sages at the Kunlun Mountain are aware of the coming chaos and send Jiang Ziya down the mountain with the “Fengshen Bang” (a list that empowers him to invest in the gods of Heaven) to find the lord of the world and save peoples. Prince Ji Fa, a diplomatic hostage of client state trained by King Zhou from an early age, gradually discovers the true colors of King Zhou, though King Zhou was used to be his hero. Ji Fa decides to escape the capital Chaoge to his hometown and plans the attack on King Zhou with the help of Jiang Ziya. The forces of all parties are surging, and the situation is changing.', 'Wuershan', 'Kris Phillips, Li Xuejian, Huang Bo, Yu Shi, Chen Muchi, Naran', '2023-09-28', 'Action/ Fantasy'),
(5, 'The Ex-Files 4: Marriage Plan 前任4：英年早婚', 'theExFiles.jpeg', 129, 'PG', NULL, 'The immensely popular EX-FILE franchise now comes to its fourth sequel in which we see buddies Meng Yun and Yu Fei coming to an age to talk about marriage.\r\n\r\nIn order to avoid problems after marriage, Yu and his girlfriend Ding Dian create a marriage cooling-off period to preview life after marriage in advance. The ups and downs of marriage indeed become challenging tests for the relationship between them.\r\n\r\nChanges in friends around and pressure from parents are getting to make Meng think about marriage. With the question “why do people get married”, he starts a blind date journey, allowing him to learn various concepts of marriage and love from his different blind dates, which makes him even more confused and struggling.\r\n\r\nAt an unexpected alumni gathering, Meng reunites with his first love. After many years, his heart is still pounding at the sight of her. He seems to finally catch a glimmer of hope, but would this girl really be the chosen one?', 'Tian Yusheng 田羽生', 'Han Geng 韩庚, Zheng Kai 郑恺', '2023-10-05', 'Comedy/ Romance'),
(6, 'Freelance', 'freelance.jpg', 109, 'NC16', 'Some Coarse Language & Violence', 'Ex-special forces operative Mason Pettis (John Cena) is stuck in a dead-end desk job when he reluctantly takes on a freelance gig to provide private security for washed-up journalist Claire Wellington (Alison Brie) as she interviews the ruthless--but impeccably dressed--dictator, Juan Venegas (Juan Pablo Raba). When a military coup breaks out just as she\'s about to get the scoop of a lifetime, the unlikely trio must figure out how to survive the jungle AND each other in order to make it out alive!', 'Pierre Model', 'John Cena, Alison Brie, Juan Pablo Raba, Christian Slater', '2023-10-26', 'Action/ Comedy'),
(7, 'Tastes Of Horror', 'tastesOfHorror.jpeg', 118, 'NC16', 'Violence & Some Coarse Language', 'An omnibus of 6 chilling stories, based on a widely popular web-comic that suit each’s horror palette.\r\n\r\nTHE RESIDENTS-ONLY GYM by Kim Yong-gyun\r\n\r\n“Taboo” – A horror that takes place in an era where many are obsessed about working out, but in this case, working out in a haunted gym.\r\n\r\nREHAB by Lim Dae-woong\r\n\r\n“Abyss” - An emergency rescue worker Ji-yeon is trapped in a secret and mysterious space after being injured during a rescue operation.\r\n\r\nDING DONG CHALLENGE by Ahn-Sang-hoon\r\n\r\n“Jealousy” - A strange dance challenge on social media that makes your wish comes true. But, you will only get once chance.\r\n\r\nTHE PREY by Yoon Eun-kyoung\r\n\r\n“Madness” - There is a myth that you get better grades if you sacrifice the blood of a four-legged creature.\r\n\r\nJACKPOT by Chae Yeo-jun\r\n\r\n“Loss” - Danger lurks in the motel which a jackpot winner stays in…\r\n\r\nGLUTTONY by Chae Yeo-jun\r\n\r\n“Envy” - How did a mukbang BJ, who got blamed for a chew-and-spit incident come back after a year and top the list again?', 'Kim Yong-gyun, Lim Dae-woong, Ahn Sang-hoon, Yoon Eun-kyoung, Chae Yeo-jun', 'Lee Joo-young, Jang Gwang, Jo Jae-yun, Kim Joo-ryong, Yoon Hyun-min, Chang Seung-yeon, Oh Seung-hee, Jang Ye-eun, Shin Eun-soo, Kim Ho-jung, Kim Tae-hun, Choi Su-im, Park Jin-a, Son Jina', '2023-10-26', 'Horror/ Supernatural'),
(8, 'Tejas', 'tejas.jpg', 114, 'PG13', 'Some Mature Content & Violence', 'Revolves around the extraordinary journey of Tejas Gill, an Air Force pilot, and aims to inspire and instill a deep sense of pride in the valiant soldiers who tirelessly defend their nation, confronting numerous challenges along the way.', 'Sarvesh Mewara', 'Kangana Ranaut, Anshul Chauhan, Varun Mitra', '2023-10-27', 'Drama/ Thriller'),
(9, 'Confinement 陪月', 'confinement.webp', 95, 'PG13', 'Horror', 'Si Ling, a pregnant painter who moves into her dream home and hires a confinement nanny after winning an award. As Si Ling begins her one month in confinement, inexplicable incidents start mounting in the house, threatening both her and her baby…\r\n\r\n电影《陪月》叙述了一位新手妈妈，艺术家王思灵，搬进一栋梦寐以求的豪宅坐月，并请来陪月嫂帮忙。然而，坐月期间却连续遭遇诡异事，妈妈与宝宝的生命都受到威胁。', 'Kelvin Tong 唐永健', 'Rebecca Lim 林慧玲, Cynthia Koh 许美珍', '2023-10-19', 'Horror/ Thriller'),
(10, 'Leo', 'leo.jpeg', 163, 'NC16', 'Violence & Some Coarse Language', 'The protagonist and his family live in a small hilly town where they run a café and lead a peaceful life. The whole town is shook when a gang of robbers enter the town which leads to a lot of people getting mysteriously killed. How this affects the protagonist\'s family and what he does to deal with it forms the crux of the story.', 'Lokesh Kanagaraj', 'Thalapathy Vijay, Sanjay Dutt, Trisha, Arjun, Gautham Vasudev Menon, Mysskin, Mansoor Ali Khan, Priya Anand', '2023-10-19', 'Action/ Crime/ Thriller'),
(11, 'A Very Good Girl', 'aVeryGoodGirl.jpg', 121, 'M18', 'Some Mature Content & Coarse Language', '(Kathryn Bernardo makes her come back after the all time hit movie- Hello, Love, goodbye) After a heartless firing triggers a chain of unfortunate events, Philo plots a meticulous revenge against retail mogul, Mother Molly, aiming to dismantle her empire and seize the ultimate payback. This time, there is no mercy.', 'Petersen Vargas', 'Kathryn Bernardo, Dolly De Leon, Donna Cariaga', '2023-10-27', 'Comedy/ Drama'),
(12, 'Air Mata Di Ujung Sajadah', 'airMataDiUjungSajadah.webp', 105, 'PG', NULL, 'Seven years have passed, Aqilla just found out that her child, Baskara, is actually alive and being raisedby Arif and Yumna, a couple who had only one hope: to have a child. Aqilla departed from her empty life in Europe to head to Solo City to embrace her new future. Will Aqilla be able to bring herself to take Baskara away, as he has been raised by Arif and Yumna for years? Indeed, Aqilla\'s blood runs in Baskara\'s veins, but there is also Yumna\'s sweat and tears there. Who has more right to be Baskara\'s mother?', 'Key Mangunsong', 'Titi Kamal, Fedi Nuril, Citra Kirana', '2023-10-12', 'Drama'),
(13, 'Sajini Shinde Ka Viral Video', 'sajiniShindeKaViralVideo.jpeg', 114, 'PG13', 'Some Coarse Language', 'Sajini Shinde Ka Viral Video is a gripping social thriller that tries to solve the mystery behind the disappearance of Sajini [Radhika Madan], a young physics teacher with dreams aplenty. A relentless Bela [Nimrat Kaur], a seasoned and highly skilled crime branch investigator, takes up the case to find out if Sajini went missing on her own or is someone behind it? The suspects are many but none as black and white as Bela would have liked. As Bela races against time to unearth the truth, where everyone is a suspect behind her disappearance, or possibly her murder, Sajini Shinde Ka Viral Video questions what is it that Sajini did and why was running away her only option?', 'Mikhil Musale', 'Radhika Madan, Nimrat Kaur, Bhagyashree, Subodh Bhave', '2023-10-27', 'Drama/ Mystery'),
(14, 'Trolls Band Together', 'trollsBandTogether.jpeg', 91, 'PG', NULL, 'This holiday season, get ready for an action-packed, all-star, rainbow-colored family reunion like no other. After two films of true friendship and relentless flirting, Poppy and Branch are now, finally, a couple! As they grow closer, Poppy discovers that Branch was once part of her favorite boyband phenomenon, BroZone, with his four brothers. BroZone disbanded when Branch was still a baby and Branch hasn’t seen his brothers since. But when Branch’s brother Floyd is kidnapped by a pair of nefarious pop-star villains, Branch and Poppy embark on a harrowing and emotional journey to reunite the other brothers.', 'Walt Dohrn, Tim Heitz', 'Anna Kendrick, Justin Timberlake, Camila Cabello, Eric André, Amy Schumer, Andrew Rannells', '2023-11-02', 'Animation'),
(15, 'Mujib: The Making Of A Nation', 'mujib.jpeg', 176, 'NC16', 'Violence', 'A biography film about Bangabandhu Sheikh Mujibur Rahman, Bangabandhu is an upcoming Bangladeshi Bengali film, directed by Shyam Benegal. This is a biopic of Bangabandhu Sheikh Mujibur Rahman. Arifin Shuvoo will play the role of Sheikh Mujibur Rahman.', 'Shyam Benegal', 'Arifin Shuvoo, Nusraat Faria Mazhar, Imam Hossain Saju', '2023-10-27', 'Biography/ Drama'),
(16, 'Hopeless', 'hopeless.jpg', 124, 'NC16', 'Violence & Coarse Language', 'For us, there are things we just have to do.\r\n\r\nA town with no future, and no hope. Seventeen-year old Yeon-gyu (HONG Xa-bin) was born in this place, and has never been to anywhere else. While enduring the repeated violence inflicted by his stepfather, he saves up money in the lone hope of moving to the Netherlands with his mother.\r\n\r\nChi-geon (SONG Joong-ki), born and raised in this town, is now a mid-level boss in a criminal organization. Having learned early in life that this world is hell, he gets by in his own way.\r\n\r\nOne day Yeon-gyu gets into a fight to protect his stepsister Hayan (KIM Hyoung-seo). Unable to raise the settlement money, Yeon-gyu is helped by Chi-geon, and in that way Yeon-gyu comes to start a new life as a member of Chi-geon’s gang. Although scared and awkward, Yeon-gyu gradually adjusts with the help of Chi-geon who is like an older brother to him. Having earned Chi-geon’s trust while fighting to survive in the gang, Yeon-gyu begins to fall into more and more dangerous circumstances.\r\n\r\nIn order to escape from hell,\r\n\r\nthey become a part of it.', 'Kim Chang-hoon', 'Hong Xa-bin, Song Joong-ki, Kim Hyoung-seo', '2023-10-19', 'Crime/ Mystery/ Thriller'),
(17, 'Dr Cheon And The Lost Talisman', 'drCheonAndTheLostTalisman.jpeg', 98, 'PG13', 'Some Violence', 'For generations, the eldest son of the village has been the protector, but the current heir, Dr. Cheon (played by Gang Dong-won), is a fake exorcist who doesn\'t believe in ghosts.\r\n\r\nUsing his penetrating insight into people\'s minds, he performs fake exorcisms and resolves cases brought to him. However, Yoo-kyung (played by Esom), a client who can see ghosts, approaches him with an offer too tempting to refuse.\r\n\r\nWith his assistant In-bae (played by Lee Dong-hwi), Dr. Cheon heads to Yoo-kyung’s house, and gets involved in a series of strange phenomena. As they delve into the mysteries there, they uncover the secrets of a talisman known as ‘Seolkyung’...\r\n\r\nA fake exorcist who doesn\'t believe in ghosts!\r\nReal incidents that shake his world are about to unfold!', 'Kim Seong-sik', 'Gang Dong-won, Huh Joon-ho, Esom, Lee Dong-hwi, Kim Jong-soo, Park Soi', '2023-10-12', 'Fantasy/ Horror/ Thriller'),
(18, 'The Bridge Curse 2: Ritual 女鬼桥2：怨鬼楼', 'theBridgeCurse.webp', 100, 'NC16', 'Horror', 'Based on an urban legend of the most haunted university in Taiwan. Rumor has it that during construction, the architect disrupted the school’s harmonizing Feng Shui and turned it into a beacon for supernatural entities. Years later, in an attempt to test their AR game on dark summoning rituals of the dead, they unknowingly unleash evil spirits on the world.\r\n\r\n传说中，文华大学位于阴阳交界之地，当年设计师将建筑物设计成镇煞用的「逆八卦」阵形，名为「大忍馆」，希望能用此镇煞阵形来困住孤魂野鬼以免伤人，没想到大忍馆因此陆续传出众多校园怪谈：不只有人搭电梯却误闯阴间、还有人撞见在教室跳舞的女鬼、更有许多学生在晚上听到幽幽的歌声⋯⋯\r\n\r\n就读文华大学的连裕婷（王渝萱饰演），自从三年前哥哥（施柏宇饰演）在校内发生意外后便昏迷不醒至今，裕婷一直想完成哥哥用毕生心血设计的AR游戏。然而当她与同学们在进入最后实测阶段时，众人却开始发生离奇诡谲的灵异事件，而裕婷也在无意间发现哥哥昏迷不醒的原因⋯⋯', 'Lester Hsi 奚岳隆', 'Wang Yu Xuan 王渝萱, JC Lin 林哲熹, Patrick Shih 施柏宇', '2023-12-01', 'Horror/ Thriller'),
(19, 'Marvel Studios\' The Marvels', 'MarvelStudiosTheMarvels.webp', 105, 'PG', NULL, 'In Marvel Studios\' \"The Marvels,\" Carol Danvers aka Captain Marvel has reclaimed her identity from the tyrannical Kree and taken revenge on the Supreme Intelligence. But unintended consequences see Carol shouldering the burden of a destabilized universe. When her duties send her to an anomalous wormhole linked to a Kree revolutionary, her powers become entangled with that of Jersey City super-fan Kamala Khan, aka Ms. Marvel, and Carol\'s estranged niece, now S.A.B.E.R. astronaut Captain Monica Rambeau. Together, this unlikely trio must team up and learn to work in concert to save the universe as \"The Marvels.\"', 'Nia DaCosta', 'Brie Larson, Samuel L. Jackson, Iman Vellani, Teyonah Parris, Emily Ng', '2023-12-04', 'Action/ Adventure'),
(20, 'The Hunger Games: The Ballad Of Songbirds And Snakes', 'theHungerGames.jpeg', 157, 'PG13', 'Some Violence', 'Experience the story of THE HUNGER GAMES -- 64 years before Katniss Everdeen volunteered as tribute, and decades before Coriolanus Snow became the tyrannical President of Panem. THE HUNGER GAMES: THE BALLAD OF SONGBIRDS & SNAKES follows a young Coriolanus (Tom Blyth) who is the last hope for his failing lineage, the once-proud Snow family that has fallen from grace in a post-war Capitol. With his livelihood threatened, Snow is reluctantly assigned to mentor Lucy Gray Baird (Rachel Zegler), a tribute from the impoverished District 12. But after Lucy Gray\'s charm captivates the audience of Panem, Snow sees an opportunity to shift their fates. With everything he has worked for hanging in the balance, Snow unites with Lucy Gray to turn the odds in their favor. Battling his instincts for both good and evil, Snow sets out on a race against time to survive and reveal if he will ultimately become a songbird or a snake.', 'Francis Lawrence', 'Tom Blyth, Rachel Zegler, Peter Dinklage, Hunter Schafer, Josh Andrés Rivera, Jason Schwartzman', '2023-11-29', 'Action/ Adventure'),
(21, 'La Luna', 'laLuna.jpg', 109, 'PG13', 'Some Sexual References', 'The sleepy and passionless town of Kampong Bras Basah has suddenly awoken with the arrival of a lingerie shop called La Luna!\r\n\r\nBut while the villagers slowly begin to welcome the shop owner with open arms, the iron fisted leader of the kampung is hell-bent to drive the shop out of town at all cost!', 'M. Raihan Halim', 'Shaheizy Sam, Sharifah Amani, Wan Hanafi Su, Hisyam Hamid, Nadiya Nisaa, Namrom, Farah Ahmad, Iedil Dzuhrie Alaudin, Wafiy Iihan, Syumaila Salihin', '2023-11-28', 'Comedy'),
(22, 'Disney\'s Wish', 'disneysWish.jpg', 90, 'PG', NULL, 'In “Wish,” Asha, a sharp-witted idealist, makes a wish so powerful that it is answered by a cosmic force—a little ball of boundless energy called Star. Together, Asha and Star confront a most formidable foe—the ruler of Rosas, King Magnifico—to save her community and prove that when the will of one courageous human connects with the magic of the stars, wondrous things can happen.', 'Chris Buck', 'Ariana DeBose, Chris Pine, Alan Tudyk', '2023-11-27', 'Animation'),
(23, 'Napolean', 'napolean.jpeg', 110, 'PG13', 'Violence', '\"Napoleon\" is a spectacle-filled action epic that details the checkered rise and fall of the iconic French Emperor Napoleon Bonaparte, played by Oscar winner Joaquin Phoenix. Against a stunning backdrop of large-scale filmmaking orchestrated by legendary director Ridley Scott, the film captures Bonaparte\'s relentless journey to power through the prism of his addictive, volatile relationship with his one true love, Josephine, showcasing his visionary military and political tactics against some of the most dynamic practical battle sequences ever filmed.', 'Ridley Scott', 'Joaquin Phoenix, Vanessa Kirby, Ben Miles, Tahar Rahim, Ludivine Sagnier, Ian McNeice', '2023-11-28', 'Action/ History/ War'),
(24, 'Immersion', 'immersion.jpg', 109, 'NC16', 'Some Violence & Sexual Scene', 'A remote island, still home to shamans, local spirit mediums whom residents trust more than even doctors. Here Tomohiko Kataoka and his “New World Project” team are conducting research into virtual reality. Suddenly there is a “red bug” system error.\r\n\r\n“Imajo,” says the shaman. Two worlds, one real, the other not, begin to intersect. In an instant mystery and death envelop the island. What is the connection with this “imajo”?\r\n\r\nWill they unlock the mystery and escape from the island?', 'Takashi Shimizu', 'Daigo Nishihata, Rina Ikoma, Yuta Hiraoka, Atomu Mizuishi, Noa Kawazoe, Ayumi Ito', '2023-11-29', 'Horror'),
(25, 'Wonka', 'wonka.jpeg', 130, 'PG', NULL, 'Based on the extraordinary character at the center of Charlie and the Chocolate Factory, Roald Dahl’s most iconic children’s book and one of the best-selling children’s books of all time, “Wonka” tells the wondrous story of how the world’s greatest inventor, magician and chocolate-maker became the beloved Willy Wonka we know today. From Paul King, writer/director of the “Paddington” films, David Heyman, producer of “Harry Potter,” “Gravity,” “Fantastic Beasts” and “Paddington,” and producers Alexandra Derbyshire (the “Paddington” films, “Jurassic World: Dominion”) and Luke Kelly (“Roald Dahl’s The Witches”), comes an intoxicating mix of magic and music, mayhem and emotion, all told with fabulous heart and humor. Starring Timothée Chalamet in the title role, this irresistibly vivid and inventive big screen spectacle will introduce audiences to a young Willy Wonka, chock-full of ideas and determined to change the world one delectable bite at a time—proving that the best things in life begin with a dream, and if you’re lucky enough to meet Willy Wonka, anything is possible.', 'Paul King\r\n\r\n', 'Timothée Chalamet, Calah Lane, Keegan-Michael Key, Paterson Joseph, Matt Lucas, Mathew Baynton, Sally Hawkins, Rowan Atkinson, Jim Carter, Olivia Colman', '2023-11-06', 'Adventure/ Fantasy'),
(26, 'Next Goal Wins', 'nextGoalWins.jpeg', 90, 'PG', NULL, 'NEXT GOAL WINS follows the American Samoa soccer team, infamous for their brutal 31-0 FIFA loss in 2001. With the World Cup Qualifiers approaching, the team hires down-on-his-luck, maverick coach Thomas Rongen (Michael Fassbender) hoping he will turn the world\'s worst soccer team around in this heartfelt underdog comedy.', 'Taika Waititi', 'Michael Fassbender, Elisabeth Moss, Will Arnett, Oscar Kightley, David Fane, Beulah Koale', '2023-12-07', 'Comedy/ Drama'),
(27, 'Migration', 'migration.jpeg', 100, 'PG', NULL, 'A family of ducks try to convince their overprotective father to go on the vacation of a lifetime.', 'Benjamin Renner, Guylo Homsy', 'Awkwafina, Elizabeth Banks, Danny DeVito', '2023-12-21', 'Animation');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `screeningId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `seatNumbers` varchar(100) NOT NULL,
  `numberOfSeats` int(11) NOT NULL,
  `totalAmount` float NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `timeOfPayment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `screeningId`, `userId`, `email`, `seatNumbers`, `numberOfSeats`, `totalAmount`, `paymentMethod`, `status`, `timeOfPayment`) VALUES
(1, 1, 1, 'zhaoyiwuu@gmail.com', 'F9, F10', 2, 25.6, 'DBS Paylah!', 'success', '2023-10-27 02:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `rating` float NOT NULL,
  `uplaodDateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `userId`, `movieId`, `comment`, `rating`, `uplaodDateTime`) VALUES
(1, 1, 1, 'breathtaking masterpiece that skillfully combines the elements of action, audio, acting, direction, and scene design into an unforgettable cinematic experience. Directed by the visionary filmmaker, Christopher Nolan, the movie takes audiences on an electrifying journey that weaves together heart-pounding action sequences, immersive audio design, exceptional performances, stunning visuals, and meticulous direction. This review delves into the movie\'s prowess in each of these crucial areas, showcasing how it harmoniously creates a symphony of emotions and adrenaline.', 5, '2023-10-28 18:26:11'),
(2, 1, 3, 'Amazing movie, good jumpscares and a great storyline with plots.', 4, '2023-10-28 19:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `id` int(11) NOT NULL,
  `timing` datetime NOT NULL,
  `movieId` int(3) NOT NULL,
  `locationId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`id`, `timing`, `movieId`, `locationId`) VALUES
(1, '2023-10-27 10:14:00', 1, 1),
(2, '2023-10-27 12:20:00', 1, 1),
(3, '2023-10-27 11:20:00', 1, 2),
(4, '2023-10-27 13:17:00', 1, 3),
(5, '2023-10-28 09:24:00', 1, 1),
(6, '2023-10-28 11:20:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password`) VALUES
(1, 'zhaoyiwuu@gmail.com', 'Zoe', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screening_payment_fk` (`screeningId`),
  ADD KEY `user_payment_fk` (`userId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_review_fk` (`movieId`),
  ADD KEY `user_review_fk` (`userId`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_screening_fk` (`movieId`),
  ADD KEY `location_screening_fk` (`locationId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `screening_payment_fk` FOREIGN KEY (`screeningId`) REFERENCES `screening` (`id`),
  ADD CONSTRAINT `user_payment_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `movie_review_fk` FOREIGN KEY (`movieId`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `user_review_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `screening`
--
ALTER TABLE `screening`
  ADD CONSTRAINT `location_screening_fk` FOREIGN KEY (`locationId`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `movie_screening_fk` FOREIGN KEY (`movieId`) REFERENCES `movie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
