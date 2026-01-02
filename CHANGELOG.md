# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-01-02

### Added
- Initial release of Deprem RSS WordPress plugin
- RSS feed integration for earthquake data
- Shortcode support: `[deprem_listesi]`
- Widget support for sidebar display
- Admin settings page with customizable options
- Auto-refresh functionality with AJAX
- Caching mechanism for improved performance
- Color-coded magnitude display
- Responsive design for mobile and desktop
- Turkish language interface
- Support for custom RSS feeds
- Magnitude-based filtering
- Configurable display count
- Manual refresh button
- Loading states and animations

### Features
- **RSS Feed Parser**: Fetch and parse earthquake data from any RSS feed
- **Customizable Display**: Control number of earthquakes shown and minimum magnitude
- **Auto-refresh**: Automatic updates without page reload
- **Cache System**: Efficient data caching to reduce server load
- **Visual Design**: Color-coded earthquakes by magnitude
- **Mobile Friendly**: Fully responsive design
- **Easy Integration**: Simple shortcode and widget implementation

### Technical Details
- WordPress 5.0+ compatibility
- PHP 7.0+ required
- Object-oriented architecture
- Transient API for caching
- WordPress Coding Standards compliant
- Secure data sanitization and validation
- AJAX-powered updates

[1.0.0]: https://github.com/integrumart/depremrss/releases/tag/v1.0.0
