-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2013 at 12:30 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tennis_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('SuperAdmin', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('emails_all_view', 0, 'View all emais.', NULL, 'N;'),
('emails_create', 0, 'Create a secondary email.', NULL, 'N;'),
('emails_delete', 0, 'Delete a secondary email.', NULL, 'N;'),
('emails_manage', 1, 'Manage secondary emails!', NULL, 'N;'),
('emails_verificationLink_resend', 0, 'Resend the verification link.', NULL, 'N;'),
('password_change', 0, 'With this right user can change the password without knowing the old password.', NULL, 'N;'),
('settings_manage', 1, 'Allow the user to change the default settings.', NULL, 'N;'),
('SuperAdmin', 2, 'The most powerful admin!', NULL, 'N;'),
('users_admin', 0, 'View all users + options.', NULL, 'N;'),
('users_all_privateProfile_view', 0, 'View a user private profile.', NULL, 'N;'),
('users_all_view', 0, 'View all users.', NULL, 'N;'),
('users_create', 0, 'Create a user.', NULL, 'N;'),
('users_delete', 0, 'Delete a user.', NULL, 'N;'),
('users_manage', 1, 'Manage users!', NULL, 'N;'),
('users_profile_update', 0, 'Update a user profile.', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('emails_manage', 'emails_all_view'),
('emails_manage', 'emails_create'),
('emails_manage', 'emails_delete'),
('SuperAdmin', 'emails_manage'),
('emails_manage', 'emails_verificationLink_resend'),
('users_manage', 'password_change'),
('SuperAdmin', 'settings_manage'),
('users_manage', 'users_admin'),
('users_manage', 'users_all_privateProfile_view'),
('users_manage', 'users_all_view'),
('users_manage', 'users_create'),
('users_manage', 'users_delete'),
('SuperAdmin', 'users_manage'),
('users_manage', 'users_profile_update');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_creation` timestamp NULL DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `emails_user_emails_UNIQUE` (`id_user`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `id_user`, `name`, `verified`, `verification_code`, `date_of_creation`, `visible`) VALUES
(1, 2, 'admin@noEmail.com', 0, NULL, NULL, 0),
(2, 3, 'demo@noEmail.com', 0, NULL, NULL, 0),
(6, 7, 'ast3234@hotmail.com', 1, NULL, NULL, 0),
(7, 8, 'reviewer@axeo.net', 0, NULL, NULL, 0),
(8, 9, 'zgli98@hotmail.com', 0, NULL, NULL, 0),
(9, 10, 'leefish@ymail.com', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `guiders_page`
--

CREATE TABLE IF NOT EXISTS `guiders_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `guiders_page`
--

INSERT INTO `guiders_page` (`id`, `page`, `description`) VALUES
(1, 'login', ''),
(2, 'signup', ''),
(3, 'home', ''),
(4, 'profile', ''),
(5, 'users_session_admin', ''),
(6, 'users_session_update', '');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_user_invited` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `invitation_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_invitation_send` timestamp NULL DEFAULT NULL,
  `date_of_invitation_accepted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitations_email_code_UNIQUE` (`email`,`invitation_code`),
  KEY `id_user` (`id_user`),
  KEY `id_user_invited` (`id_user_invited`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `id_user`, `id_user_invited`, `email`, `note`, `invitation_code`, `date_of_invitation_send`, `date_of_invitation_accepted`) VALUES
(1, 10, NULL, 'dmkfinancial@gmail.com', '', '6753', '2013-09-19 15:11:10', NULL);

--
-- Triggers `invitations`
--
DROP TRIGGER IF EXISTS `trg_invitations_bi`;
DELIMITER //
CREATE TRIGGER `trg_invitations_bi` BEFORE INSERT ON `invitations`
 FOR EACH ROW BEGIN
        SET NEW.date_of_invitation_send = current_timestamp;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `password_recovery`
--

CREATE TABLE IF NOT EXISTS `password_recovery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `long_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `date_of_request` timestamp NULL DEFAULT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `password_recovery_lc_UNIQUE` (`long_code`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Triggers `password_recovery`
--
DROP TRIGGER IF EXISTS `trg_password_recovery_bi`;
DELIMITER //
CREATE TRIGGER `trg_password_recovery_bi` BEFORE INSERT ON `password_recovery`
 FOR EACH ROW BEGIN
        SET NEW.date_of_request = current_timestamp;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `session_photos`
--

CREATE TABLE IF NOT EXISTS `session_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(10) unsigned NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `session_id_2` (`session_id`),
  KEY `session_id_3` (`session_id`),
  KEY `session_id_4` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `session_photos`
--

INSERT INTO `session_photos` (`id`, `session_id`, `file_name`, `file_type`, `file_size`) VALUES
(9, 2, '1377920310forehand.png', 'image/png', 230370),
(11, 3, '13784018102013-02-11 17.14.50.jpg', 'image/jpeg', 38051),
(12, 2, '1379131720backhand.png', 'image/png', 210126);

-- --------------------------------------------------------

--
-- Table structure for table `session_videos`
--

CREATE TABLE IF NOT EXISTS `session_videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(10) unsigned NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `session_id_2` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `session_videos`
--

INSERT INTO `session_videos` (`id`, `session_id`, `file_name`, `file_type`, `file_size`) VALUES
(3, 2, '086.mp4', 'video/mp4', 10723848);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date_of_update` timestamp NULL DEFAULT NULL,
  `setting_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `label`, `description`, `date_of_update`, `setting_order`) VALUES
(1, 'logInIfNotVerified', '1', 'Allow users to LogIn if they are not active?', '', '2013-09-12 02:55:03', 100),
(2, 'enabledSignUp', '1', 'SignUp is enabled?', 'If SignUp is disabled, no SignUps are allowed, in any case!', '2013-09-12 02:55:03', 200),
(3, 'invitationBasedSignUp', '0', 'Only invited users are allowed to SignUp?', 'If SignUp is disabled, no user can SignUp, even invited ones!', '2013-09-12 02:55:03', 300),
(4, 'invitationButtonDisplay', '1', 'Display the invitation button to all users?', '', '2013-09-12 02:55:03', 400),
(5, 'invitationDefaultNumber', '5', 'Default number of invitations per user? (if <0 = infinit number)', '', '2013-09-12 02:55:03', 500),
(6, 'invitationEmail', 'tennis@tennisbridge.com', 'Invitation email is sent from:', '', '2013-09-12 02:55:03', 600),
(7, 'hoursInvitationLinkIsActive', '144', 'How many hours the invitation link is active? (if <0 = forever)', '', '2013-09-12 02:55:03', 700),
(8, 'hoursActivationLinkIsActive', '72', 'How many hours the activation link is active? (if <0 = forever)', '', '2013-09-12 02:55:03', 900),
(9, 'notificationSignUpEmail', 'tennis@tennisbridge.com', 'Activation email is sent from:', '', '2013-09-12 02:55:03', 800),
(10, 'hoursVerificationLinkIsActive', '144', 'How many hours the email verification link is active? (if <0 = forever)', 'How many hours the email verification link is active? (when user associates a new email address to his/hers account)', '2013-09-12 02:55:03', 1000),
(11, 'notificationVerificationEmail', 'tennis@tennisbridge.com', 'Verification email is sent from:', '', '2013-09-12 02:55:03', 1100),
(12, 'passwordRecoveryEmail', 'tennis@tennisbridge.com', 'Password recovery email is sent from:', '', '2013-09-12 02:55:03', 1200),
(13, 'hoursPasswordRecoveryLinkIsActive', '10', 'How many hours the password recovery request is active?', '', '2013-09-12 02:55:03', 1300),
(14, 'trackPasswordRecoveryRequests', '0', 'Track password recovery requests?', 'If it''s true, than if a password recovery request expire, it is not deleted, but it''s property "expired" is set to true. So in the database remain all password requests that have been made.', '2013-09-12 02:55:03', 1400);

--
-- Triggers `settings`
--
DROP TRIGGER IF EXISTS `trg_settings_bu`;
DELIMITER //
CREATE TRIGGER `trg_settings_bu` BEFORE UPDATE ON `settings`
 FOR EACH ROW BEGIN
        SET NEW.date_of_update = current_timestamp;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noEmail@noEmail.com',
  `pass` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_of_creation` timestamp NULL DEFAULT NULL,
  `date_of_update` timestamp NULL DEFAULT NULL,
  `date_of_last_access` timestamp NULL DEFAULT NULL,
  `date_of_password_last_change` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `users_email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `pass`, `salt`, `name`, `surname`, `active`, `status`, `date_of_creation`, `date_of_update`, `date_of_last_access`, `date_of_password_last_change`) VALUES
(2, 'admin', 'admin@noEmail.com', '$6$rounds=12587$ 52124a8a000304.$jxfuCwVKKuqi2GvzOdSbOF1J7Hf9QFTTOqXqLjaGHov7qWpSDmO.UiszcpGYshffYphniKFx46FP7v0AMueLH/', '52124a8a000304.04619223', 'Admin', 'Admin', 1, 0, '2013-08-19 16:40:42', '2013-09-15 23:57:00', '2013-09-15 23:57:00', '2013-08-19 16:40:42'),
(3, 'demo', 'demo@noEmail.com', '$6$rounds=12587$ 52124a8a095b75.$WEJRH1G.4Y50PG.0QibNVtfoivUFnOyU0VOqGAcnsRGJGk1.9pIix2hbOCGEK0P0oqXsVunqzEaVQT2x2wZqM1', '52124a8a095b75.18003094', 'Demo', 'Demo', 1, 0, '2013-08-19 16:40:42', '2013-09-23 03:07:57', '2013-09-23 03:07:57', '2013-08-19 16:40:42'),
(7, 'test2', 'ast3234@hotmail.com', '$6$rounds=12587$ 5222ac1f078c01.$FUAYnrs5EqFEHcv7.QVCMbnBJplmT8E73w7.T/JaDqvTuzwZ/iXp3PzpT74.aN2JDlaoQbYZE2jabcc843.CM.', '5222ac1f078c01.81566624', 'Student2', '', 1, 0, '2013-09-01 02:49:19', '2013-09-01 02:53:19', '2013-09-01 02:52:10', '2013-09-01 02:53:19'),
(8, 'reviewer', 'reviewer@axeo.net', '$6$rounds=12587$ 522a9f36abf9b2.$YTg7Q3fDgFV0VpfJcWqFnd4Dvq8oSzlKv4WO2j8LExV.VziTPRymxf2tVx.qQO1Nn8l8jtVmzDmg.DEY2GFsk.', '522a9f36abf9b2.31350172', 'Reviewer', '', 1, 0, '2013-09-07 03:36:22', '2013-09-29 23:51:40', '2013-09-29 23:51:40', '2013-09-07 03:36:22'),
(9, 'zgli98@hotmail.com', 'zgli98@hotmail.com', '$6$rounds=12587$ 522d0f65608043.$YNgGu4myG03zH1AbH7C.eUTjFMujybIp9OJGJchRqQyoZ/TbU23Iuv26IxNY.x063N7JRAqSob2ZSFSZFmJn81', '522d0f65608043.40149669', '', '', 1, 0, '2013-09-08 23:59:33', '2013-09-14 20:43:48', '2013-09-14 20:43:48', '2013-09-08 23:59:33'),
(10, 'leefish', 'leefish@ymail.com', '$6$rounds=12587$ 523b0ec935db96.$p5.B8fy1wKu3CMr/Xtgxjc4xKOd4KUDjgZUtPknaXHFLmHQGv3DMef3XWELyP1GZhFr7qRE7yuFIhixjnNpNC1', '523b0ec935db96.47451938', NULL, NULL, 1, 0, '2013-09-19 14:48:41', '2013-09-19 15:08:35', '2013-09-19 15:08:35', '2013-09-19 14:48:41');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `trg_users_bi`;
DELIMITER //
CREATE TRIGGER `trg_users_bi` BEFORE INSERT ON `users`
 FOR EACH ROW BEGIN
        SET NEW.date_of_creation = current_timestamp;
        SET NEW.date_of_update =  current_timestamp;
        SET NEW.date_of_last_access =  current_timestamp;
        SET NEW.date_of_password_last_change =  current_timestamp;
    END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_users_bu`;
DELIMITER //
CREATE TRIGGER `trg_users_bu` BEFORE UPDATE ON `users`
 FOR EACH ROW BEGIN
        SET NEW.date_of_update =  current_timestamp;
        IF NEW.pass != OLD.pass THEN
            SET NEW.date_of_password_last_change =  current_timestamp;
        END IF;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE IF NOT EXISTS `users_data` (
  `id` bigint(20) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `obs` text COLLATE utf8_unicode_ci,
  `site` varchar(1500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_update` timestamp NULL DEFAULT NULL,
  `invitations_left` smallint(6) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `description`, `obs`, `site`, `facebook_address`, `twitter_address`, `activation_code`, `date_of_update`, `invitations_left`) VALUES
(2, 'The default SuperAdmin user!', NULL, NULL, NULL, NULL, 'f9a1124ca6b09576777d392a8273da5965438ab6', NULL, -1),
(3, 'USTA 4.0 player', NULL, '', '', '', 'a5c0804c15501124a6722b11c4c301f5e8576c8c', NULL, -1),
(7, 'test user', NULL, '', '', '', '5ab5aef2204e01bcf928d2b4a9de3ca30f62f3a7', NULL, 5),
(8, 'To manage the review tab', '', '', '', '', '25df95a77a0a9e11aa649eedee537c28a79151a9', NULL, 5),
(9, '', '', '', '', '', 'aac27a5de0a07de743904e563e02a353286b5b18', NULL, 5),
(10, NULL, NULL, NULL, NULL, NULL, 'b25673e0d52cd1d788b1e8f00faa9c0493872cb8', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_guiders_flag`
--

CREATE TABLE IF NOT EXISTS `users_guiders_flag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guiders_page_id` int(10) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `flag` tinyint(1) NOT NULL COMMENT '1=>set, 0=>not set',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `guiders_page_id` (`guiders_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users_guiders_flag`
--

INSERT INTO `users_guiders_flag` (`id`, `guiders_page_id`, `user_id`, `flag`) VALUES
(3, 6, 3, 1),
(4, 1, 7, 0),
(5, 2, 7, 0),
(6, 3, 7, 0),
(7, 4, 7, 0),
(8, 5, 7, 0),
(9, 6, 7, 0),
(10, 6, 2, 1),
(11, 6, 8, 1),
(12, 6, 9, 1),
(13, 1, 10, 0),
(14, 2, 10, 0),
(15, 3, 10, 0),
(16, 4, 10, 0),
(17, 5, 10, 0),
(18, 6, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `problem` varchar(40) NOT NULL,
  `subjective` longtext NOT NULL,
  `objective` longtext NOT NULL,
  `assessment` longtext NOT NULL,
  `plan` longtext NOT NULL,
  `score` varchar(255) NOT NULL,
  `aces` int(10) unsigned NOT NULL,
  `double_faults` int(10) unsigned NOT NULL,
  `winners` int(10) unsigned NOT NULL,
  `unforced_errors` int(10) unsigned NOT NULL,
  `mechanics` text NOT NULL,
  `timing` text NOT NULL,
  `footwork` text NOT NULL,
  `fitness` text NOT NULL,
  `effectiveness` text NOT NULL,
  `strategy` text NOT NULL,
  `serves_number_of` int(10) unsigned NOT NULL,
  `forehands_number_of` int(10) unsigned NOT NULL,
  `backhands_number_of` int(10) unsigned NOT NULL,
  `game_on_off` tinyint(1) NOT NULL,
  `serve_on_off` tinyint(1) NOT NULL,
  `return_on_off` tinyint(1) NOT NULL,
  `level` varchar(255) NOT NULL,
  `ranking` varchar(255) NOT NULL,
  `target_level` varchar(255) NOT NULL,
  `target_ranking` varchar(255) NOT NULL,
  `serve_mph` int(5) unsigned NOT NULL,
  `forehand_mph` int(5) unsigned NOT NULL,
  `backhand_mph` int(5) unsigned NOT NULL,
  `forehand_longest_rally` int(10) unsigned NOT NULL,
  `backhand_longest_rally` int(10) unsigned NOT NULL,
  `strokes_longest_rally` int(10) unsigned NOT NULL,
  `footwork_speed_sidetoside` int(10) unsigned NOT NULL,
  `footwork_speed_forward` int(10) unsigned NOT NULL,
  `footwork_speed_backward` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `name`, `date`, `problem`, `subjective`, `objective`, `assessment`, `plan`, `score`, `aces`, `double_faults`, `winners`, `unforced_errors`, `mechanics`, `timing`, `footwork`, `fitness`, `effectiveness`, `strategy`, `serves_number_of`, `forehands_number_of`, `backhands_number_of`, `game_on_off`, `serve_on_off`, `return_on_off`, `level`, `ranking`, `target_level`, `target_ranking`, `serve_mph`, `forehand_mph`, `backhand_mph`, `forehand_longest_rally`, `backhand_longest_rally`, `strokes_longest_rally`, `footwork_speed_sidetoside`, `footwork_speed_forward`, `footwork_speed_backward`) VALUES
(2, 3, 'Practice', '2013-08-22 00:00:00', 'forehand; serve', 'I played well today.  My game was ON.\r\ntest sub notes', 'too many double faults\r\n2nd serve too weak', 'Forehand is improving\r\nserve is not effective\r\nforehand is not effective', 'need more wide forehands\r\nlearn to kick a 2nd serve\r\n', '6-3,  6-4', 5, 4, 3, 2, 'She starts with a good platform stance. Grip should be turned more towards continental grip.  Needs more shoulder turn and coil as racket goes back. ', '', '', 'As she gets stronger, legs will help increase power.', 'Current grip will lead to less consistent and accurate serve.  Without coil, free points off of serve will be tough.  ', 'With current serve, point will start neutral.', 8, 0, 0, 1, 0, 0, 'junior boys 16', '22 in S cal', 'junior boys 18', 'top 10', 130, 150, 120, 120, 120, 120, 120, 140, 160),
(3, 3, 'Match', '2013-08-25 00:00:00', '', '', '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 9, '2013-09-14', '2013-09-14 00:00:00', '', '', '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'Jack''s lesson with coach Marc', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 10, 'lee fish', '2013-09-19 00:00:00', 'racquet slips out of hand', '', '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'unknown', 'unknown', 'even par', 'seargent-major', 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`id_user_invited`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `password_recovery`
--
ALTER TABLE `password_recovery`
  ADD CONSTRAINT `password_recovery_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_photos`
--
ALTER TABLE `session_photos`
  ADD CONSTRAINT `session_photos_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `users_session` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `session_videos`
--
ALTER TABLE `session_videos`
  ADD CONSTRAINT `session_videos_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `users_session` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_data`
--
ALTER TABLE `users_data`
  ADD CONSTRAINT `users_data_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_guiders_flag`
--
ALTER TABLE `users_guiders_flag`
  ADD CONSTRAINT `users_guiders_flag_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_guiders_flag_ibfk_2` FOREIGN KEY (`guiders_page_id`) REFERENCES `guiders_page` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_session`
--
ALTER TABLE `users_session`
  ADD CONSTRAINT `users_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         