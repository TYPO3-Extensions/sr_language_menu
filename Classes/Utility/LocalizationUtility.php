<?php
namespace SJBR\SrLanguageMenu\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2013 Extbase Team (http://forge.typo3.org/projects/typo3v4-mvc)
 *  (c) 2013-2014 Stanislas Rolland <typo3(arobas)sjbr.ca>
 *  Extbase is a backport of TYPO3 Flow. All credits go to the TYPO3 Flow team.
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Localization helper used to fetch localized labels in a language other than the current language
 *
 * @api
 */
class LocalizationUtility extends \TYPO3\CMS\Extbase\Utility\LocalizationUtility {

	/**
	 * Configured language
	 *
	 * @var string
	 */
	static protected $configuredLanguage = '';

	/**
	 * Sets an alternate localization language
	 *
	 * @param string $extensionName
	 * @return void
	 */
	static public function setAlternateLanguage($language, $extensionName) {
		if (self::$configuredLanguage) {
			self::restoreConfiguredLanguage($extensionName);
		}
		self::$configuredLanguage = self::getFrontendObject()->config['config']['language'];
		self::getFrontendObject()->config['config']['language'] = $language;
		unset(parent::$LOCAL_LANG[$extensionName]);
	}

	/**
	 * Restores the configured localization language
	 *
	 * @param string $extensionName
	 * @return void
	 */
	static public function restoreConfiguredLanguage($extensionName) {
		if (self::$configuredLanguage) {
			self::getFrontendObject()->config['config']['language'] = self::$configuredLanguage;
			unset(parent::$LOCAL_LANG[$extensionName]);
			self::$configuredLanguage = '';
		}
	}

	/**
	 * Returns an instance of the Frontend object.
	 *
	 * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 */
	static protected function getFrontendObject() {
		return $GLOBALS['TSFE'];
	}
}