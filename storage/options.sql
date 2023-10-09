-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 01, 2021 at 07:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipda3_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `display_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_type` enum('fileWithPreview','editor','textarea','number','email','date','text') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `display_name_ar`, `display_name_en`, `key`, `value`, `data_type`, `created_at`, `updated_at`) VALUES
(8, 'عنوان الصفحة', 'head', 'head', 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه', 'editor', '2019-12-08 14:00:27', '2019-12-08 14:07:51'),
(9, 'احنا مين ؟', 'احنا مين ؟', 'who_are_we', '<h1 style=\"color: #5d71ac; font-family: tahoma, sans-serif; font-size: 14px;\"><b>لوريم ايبسوم&nbsp;دولار سيت أميت ,كونسيكتيتور أدايبا<br></b><b> يسكينج أليايت,سيت دو أيوسمود تيمبور</b></h1><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\"><b><br></b></p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد</p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس</p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أيوتي أريري دولار </p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\"><br></p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور.</p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\"> أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا</p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\"><br></p><p dir=\"rtl\" style=\"color: #5d71ac; font-family: tahoma, sans-serif; font-size: 14px;\"><b>كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم.\"</b></p><p dir=\"rtl\" style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\"><br></p><ul><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">\"سيت يتبيرسبايكياتيس يوندي أومنيس أستي ناتيس أيررور سيت فوليبتاتيم أكيسأنتييوم</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">دولاريمكيو لايودانتيوم,توتام ريم أبيرأم,أيكيو أبسا كيواي أب أللو أنفينتوري فيرأتاتيس ايت</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كياسي أرشيتيكتو بيتاي فيتاي ديكاتا سيونت أكسبليكابو. نيمو أنيم أبسام فوليوباتاتيم كيواي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">فوليوبتاس سايت أسبيرناتشر أيوت أودايت أيوت فيوجايت, سيد كيواي كونسيكيونتشر ماجناي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">دولارس أيوس كيواي راتاشن فوليوبتاتيم سيكيواي نيسكايونت. نيكيو بوررو كيوايسكيوم</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">ايست,كيواي دولوريم ايبسيوم كيوا دولار سايت أميت, كونسيكتيتيور,أديبايسكاي فيلايت, سيد</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كيواي نون نيومكيوام ايايوس موداي تيمبورا انكايديونت يوت لابوري أيت دولار ماجنام</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">ألايكيوام كيوايرات فوليوبتاتيم. يوت اينايم أد مينيما فينيام, كيواس نوستريوم أكسيركايتاشيم</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">يلامكوربوريس سيوسكايبيت لابورايوسام, نايساي يوت ألايكيوايد أكس أيا كوموداي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كونسيكيواتشر؟ كيوايس أيوتيم فيل أيوم أيوري ريبريهينديرايت كيواي ان إيا فوليوبتاتي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">فيلايت ايسسي كيوم نايهايل موليستايا كونسيكيواتيو,فيلايليوم كيواي دولوريم أيوم فيوجايات كيو</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">فوليوبتاس نيولا باراياتيور؟\"</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">\" أت فيرو ايوس ايت أكيوساميوس ايت أيوستو أودايو دايجنايسسايموس ديوكايميوس كيواي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">بلاندايتاييس برايسينتايوم فوليوبتاتيوم ديلينايتاي أتكيوي كورريوبتاي كيوأوس دولوريس أيت</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">سيما يليكيوسيونت ان كيولبا كيواي أوفايكيا ديسيريونت موللايتايا انايماي, أيدي ايست لابوريوم</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">دايستا ينستايو. نام لايبيرو تيمبور, كيوم سوليوتا نوبايس ايست ايلاجينداي أوبتايو كيومكيوي</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">نايهايل ايمبيدايت كيو ماينيوس ايدي كيوود ماكسهيمي بلاسايت فاسيري بوسسايميوس,أومنايس</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">فوليوبتاس ايت ايوت أسسيو ميندايست, أومنيوس دولار ريبيللينديوس. تيمبورايبيوس أيوتيم</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كيواس موليستاياس أكسكيبتيوراي ساينت أوككايكاتاي كيبايدايتات نون بروفايدنت</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أيت دولوريوم فيوجا.ايت هاريوم كيوايديم ريريوم فاكايلايسايست ايت أكسبيدايتا</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كيوايبيوسدام ايت أوت</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أوففايكايس ديبايتايس أيوت ريريوم نيسيسسايتاتايبيوس سايبي ايفينايت يوت ايت فوليبتاتيس&nbsp;</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">ريبيودايايانداي ساينت ايت موليسفاياي نون ريكيوسانداي.اتاكيوي ايريوم ريريوم هايس تينيتور</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">أ ساباينتي ديليكتيوس, يوت أيوت رياسايندايس فوليوبتاتايبص مايوريس ألايس</li><li style=\"color: rgb(66, 66, 66); font-family: tahoma, sans-serif; font-size: 14px;\">كونسيكيواتور أيوت بيرفيريندايس دولورايبيوس أسبيرايوريس ريبيللات .</li></ul>', 'editor', '2019-12-08 14:01:23', '2020-09-08 13:09:35'),
(10, 'العنوان', 'address', 'address', 'القاهرة- المعادي- كورنيش النيل', 'text', '2019-12-08 14:02:11', '2019-12-08 14:02:11'),
(11, 'البريد الالكتروني', 'email', 'email', 'company-name@email.com', 'email', '2019-12-08 14:02:48', '2019-12-08 14:02:48'),
(12, 'رقم الهاتف', 'phone', 'phone', '20123456789+', 'text', '2019-12-08 14:03:37', '2019-12-08 14:03:37'),
(13, 'رابط الفيس بوك', 'facebook_link', 'facebook_link', 'https://www.facebook.com/profile.php?id=445882005803088', 'text', '2019-12-08 14:05:33', '2019-12-08 14:05:33'),
(14, 'رابط التويتر', 'tweeter_link', 'tweeter_link', '#', 'text', '2019-12-08 14:06:25', '2019-12-08 14:06:25'),
(15, 'رابط انستاجرام', 'instagram_link', 'instagram_link', '#', 'text', '2019-12-08 14:07:06', '2019-12-08 14:07:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
