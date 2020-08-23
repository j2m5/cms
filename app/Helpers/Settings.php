<?php

use App\Repositories\SettingRepository;

if (!function_exists('siteName')) {
    function siteName()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(1);
    }
}

if (!function_exists('siteDescription')) {
    function siteDescription()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(2);
    }
}

if (!function_exists('siteLogo')) {
    function siteLogo()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(3);
    }
}

if (!function_exists('siteMetaDescription')) {
    function siteMetaDescription()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(4);
    }
}

if (!function_exists('siteMetaKeywords')) {
    function siteMetaKeywords()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(5);
    }
}

if (!function_exists('currentTheme')) {
    function currentTheme()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(6);
    }
}

if (!function_exists('adminEmail')) {
    function adminEmail()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(7);
    }
}

if (!function_exists('countOnPage')) {
    function countOnPage()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(8);
    }
}

if (!function_exists('countPostsOnPage')) {
    function countPostsOnPage()
    {
        $settings = app(SettingRepository::class);
        return $settings->getSiteSettings(9);
    }
}
