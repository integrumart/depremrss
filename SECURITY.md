# Security Policy

## Security Summary

The Deprem RSS WordPress plugin has been designed with security as a top priority. All code has been reviewed and tested for common vulnerabilities.

## Security Scan Results

**CodeQL Security Scan**: ✅ **0 Vulnerabilities Found**

- JavaScript Analysis: 0 alerts
- Date: January 2, 2026
- Status: **PASSED**

## Security Features

### 1. Direct Access Prevention
- All PHP files include `ABSPATH` check
- Prevents direct file access outside WordPress

```php
if (!defined('ABSPATH')) {
    exit;
}
```

### 2. Output Escaping
All output is properly escaped to prevent XSS:
- `esc_html()` - For HTML content
- `esc_attr()` - For HTML attributes
- `esc_url()` - For URLs
- `esc_js()` - For JavaScript

### 3. Input Sanitization
All user inputs are sanitized:
- `sanitize_text_field()` - Text fields
- `absint()` - Integers
- `floatval()` - Float numbers
- `esc_url_raw()` - URLs

### 4. Nonce Validation
AJAX requests are protected with nonces:
```php
wp_create_nonce('depremrss_nonce')
check_ajax_referer('depremrss_nonce', 'nonce')
```

### 5. Capability Checks
Admin functions check user capabilities:
```php
if (!current_user_can('manage_options')) {
    return;
}
```

### 6. No Direct SQL Queries
- Uses WordPress APIs only
- No direct database access
- No SQL injection risk

### 7. Data Validation
All data is validated before use:
- Magnitude ranges (0-10)
- Count limits (1-100)
- Time intervals with minimum values

## Reporting Security Issues

If you discover a security vulnerability, please:

1. **DO NOT** open a public issue
2. Email the maintainer directly at the repository
3. Include:
   - Description of the vulnerability
   - Steps to reproduce
   - Potential impact
   - Suggested fix (if available)

We will respond within 48 hours and work on a fix.

## Security Best Practices for Users

### Installation
1. Download only from official sources (GitHub, WordPress.org)
2. Verify file integrity
3. Keep WordPress and PHP updated

### Configuration
1. Use HTTPS for RSS feed URLs when possible
2. Set reasonable cache durations
3. Limit display counts to prevent performance issues
4. Use strong WordPress admin passwords

### Maintenance
1. Keep the plugin updated
2. Monitor WordPress security advisories
3. Regular backups
4. Review access logs

## Security Checklist

- [x] ABSPATH protection implemented
- [x] All output properly escaped
- [x] All input sanitized
- [x] Nonce validation for AJAX
- [x] Capability checks for admin functions
- [x] No direct SQL queries
- [x] No file system writes
- [x] No eval() or similar dangerous functions
- [x] No shell commands execution
- [x] Proper error handling
- [x] CodeQL security scan passed
- [x] Code review completed

## WordPress Security Standards

This plugin follows WordPress security best practices:
- [WordPress Plugin Security](https://developer.wordpress.org/plugins/security/)
- [Data Validation](https://developer.wordpress.org/plugins/security/data-validation/)
- [Securing Input](https://developer.wordpress.org/plugins/security/securing-input/)
- [Securing Output](https://developer.wordpress.org/plugins/security/securing-output/)
- [Nonces](https://developer.wordpress.org/plugins/security/nonces/)

## Updates

Security updates will be released as needed. Monitor:
- GitHub releases
- WordPress.org plugin page
- Security advisories

## Contact

For security concerns:
- GitHub Issues: https://github.com/integrumart/depremrss/issues
- Mark as "security" label

## License

This security policy is part of the GPL v2 licensed Deprem RSS plugin.

Last Updated: January 2, 2026
