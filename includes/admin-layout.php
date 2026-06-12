<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/helpers.php';
requireAdmin();
$__user = currentUser();
$__s = siteSettings();
$__currentPath = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
<?php
$headContext    = 'admin';
$__pageHeader   = $pageTitle ?? 'Admin';
$pageTitle      = $__pageHeader . ' — Admin | ' . SITE_NAME;
require __DIR__ . '/head.php';
?>
</head>
<body style="min-height:100vh;background:var(--background);color:var(--foreground);">

<!-- Mobile overlay -->
<div id="admin-sidebar-overlay" onclick="closeAdminSidebar()"></div>

<div id="admin-shell">

  <!-- ══════════════════════════════════════════════════════
       SIDEBAR
       ══════════════════════════════════════════════════════ -->
  <aside id="admin-sidebar">

    <!-- Header / Brand -->
    <div class="sb-header">
      <?php if (!empty($__s['logo_url'])): ?>
        <a href="<?= url('admin/index.php') ?>" class="sb-logo">
          <img src="<?= e($__s['logo_url']) ?>" alt="<?= e($__s['site_name'] ?? SITE_NAME) ?>">
        </a>
      <?php else: ?>
        <a href="<?= url('admin/index.php') ?>" class="sb-logo">
          <?= strtoupper(substr(SITE_NAME, 0, 2)) ?>
        </a>
      <?php endif; ?>
      <span class="sb-brand">Admin Panel</span>
      <button type="button" onclick="closeAdminSidebar()" class="sb-close-btn"
              id="admin-sidebar-close-btn" title="Close menu">
        <?= icon('x', 16) ?>
      </button>
    </div>

    <!-- Nav -->
    <nav class="sb-nav" id="admin-nav">
      <?php
      // ── Direct top-level links ────────────────────────────────
      $directLinks = [
        ['index.php',     'layout-dashboard', 'Dashboard'],
        ['analytics.php', 'bar-chart-2',      'Analytics'],
        ['search.php',    'search',           'Global Search'],
        ['branches.php',  'git-branch',       'Branches'],
        ['status.php',    'activity',         'Status Page'],
      ];

      // ── Grouped sections ──────────────────────────────────────
      $adminNavGroups = [
        'Content' => [
          ['page-content.php',   'layout-grid',    'Page Content (CMS)'],
          ['team.php',           'users',           'Team'],
          ['services.php',       'settings',        'Services'],
          ['products.php',       'package',         'Products'],
          ['portfolio.php',      'briefcase',       'Portfolio'],
          ['testimonials.php',   'star',            'Testimonials'],
          ['gallery.php',        'image',           'Gallery'],
          ['partners.php',       'handshake',       'Partners'],
          ['pricing.php',        'tag',             'Pricing Plans'],
          ['pricing-table.php',  'table',           'Pricing Table'],
          ['news.php',           'newspaper',       'News & Blog'],
          ['faqs.php',           'help-circle',     'FAQs'],
          ['careers.php',        'clipboard-list',  'Careers'],
          ['tech-expertise.php', 'cpu',             'Tech Expertise'],
          ['pages.php',          'file-text',       'CMS Pages'],
          ['legal.php',          'shield',          'Legal Pages'],
        ],
        'CRM' => [
          ['clients.php',        'building-2',      'Clients'],
          ['contacts.php',       'mail',            'Contacts'],
          ['orders.php',         'shopping-cart',   'Orders'],
          ['subscribers.php',    'mail-check',      'Subscribers'],
          ['demo-requests.php',  'telescope',       'Demo Requests'],
          ['applications.php',   'clipboard',       'Job Applications'],
          ['crm.php',            'target',          'CRM & Follow-ups'],
        ],
        'Support' => [
          ['tickets.php',        'ticket',          'Tickets'],
          ['sla.php',            'timer',           'SLA Policies'],
          ['email-intake.php',   'mail',            'Email Intake'],
          ['kb.php',             'book-open',       'Knowledge Base'],
          ['livechat.php',       'message-circle',  'Live Chat'],
          ['announcements.php',  'megaphone',       'Announcements'],
          ['banners.php',        'layout-template', 'Banners'],
        ],
        'Subscriptions' => [
          ['subscriptions.php',  'repeat',          'Subscriptions'],
          ['licenses.php',       'key-round',       'License Keys'],
        ],
        'Settings' => [
          ['settings.php',         'settings-2',    'Settings'],
          ['company-settings.php', 'building-2',    'Company Settings'],
          ['users.php',            'user',          'Users'],
          ['staff.php',            'user-cog',      'Staff'],
          ['support-contacts.php', 'phone',         'Support Contacts'],
          ['audit-log.php',        'search',        'Audit Log'],
        ],
      ];

      // Group icon map
      $grpIcons = [
        'Content'       => 'file-text',
        'CRM'           => 'target',
        'Support'       => 'headphones',
        'Subscriptions' => 'repeat',
        'Settings'      => 'sliders-horizontal',
      ];

      // Which group is active?
      $activeGroup = null;
      foreach ($adminNavGroups as $grpLabel => $grpItems) {
        foreach ($grpItems as $n) {
          if ($n[0] === $__currentPath) { $activeGroup = $grpLabel; break 2; }
        }
      }

      // Render direct links
      foreach ($directLinks as [$file, $iconName, $label]):
        $active = $__currentPath === $file;
      ?>
      <a href="<?= url('admin/' . $file) ?>" onclick="closeAdminSidebar()"
         class="sb-link<?= $active ? ' active' : '' ?>">
        <span class="sb-icon"><?= icon($iconName, 15) ?></span>
        <span class="sb-label"><?= e($label) ?></span>
      </a>
      <?php endforeach; ?>

      <div class="sb-divider"></div>

      <?php foreach ($adminNavGroups as $grpLabel => $grpItems):
        $isActive = $activeGroup === $grpLabel;
        $grpId    = 'nav-grp-' . strtolower(preg_replace('/\W+/', '-', $grpLabel));
        $grpIcon  = $grpIcons[$grpLabel] ?? 'folder';
      ?>
      <div>
        <button type="button" onclick="toggleNavGroup('<?= $grpId ?>')"
                class="sb-group-btn<?= $isActive ? ' grp-active' : '' ?>">
          <span class="sb-icon"><?= icon($grpIcon, 14) ?></span>
          <span class="sb-label sb-group-spacer"><?= e($grpLabel) ?></span>
          <span class="sb-chevron<?= $isActive ? ' open' : '' ?>" id="<?= $grpId ?>-chevron">
            <?= icon('chevron-down', 13) ?>
          </span>
        </button>

        <div id="<?= $grpId ?>" class="sb-group-children"
             style="<?= $isActive ? '' : 'display:none;' ?>">
          <?php foreach ($grpItems as [$file, $iconName, $label]):
            $active = $__currentPath === $file; ?>
          <a href="<?= url('admin/' . $file) ?>" onclick="closeAdminSidebar()"
             class="sb-link<?= $active ? ' active' : '' ?>"
             style="font-size:0.7875rem;padding-left:0.875rem;">
            <span class="sb-icon"><?= icon($iconName, 13) ?></span>
            <span class="sb-label"><?= e($label) ?></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>

      <?php if (isSuperAdmin()): ?>
      <div class="sb-divider"></div>
      <?php $saActive = $__currentPath === 'manage-admins.php'; ?>
      <a href="<?= url('admin/manage-admins.php') ?>" onclick="closeAdminSidebar()"
         class="sb-link<?= $saActive ? ' active' : '' ?>"
         style="<?= $saActive ? 'background:rgba(236,72,153,0.12);color:#ec4899;' : '' ?>">
        <span class="sb-icon"><?= icon('shield', 15) ?></span>
        <span class="sb-label" style="font-weight:600;">Manage Admins</span>
      </a>
      <?php endif; ?>

      <div class="sb-divider"></div>
      <?php foreach ([
        ['security.php',    'shield',   'My 2FA'],
        ['sessions.php',    'activity', 'My Sign-ins'],
        ['cron-status.php', 'clock',    'Cron Status'],
      ] as [$tf, $ti, $tlabel]):
        $tA = $__currentPath === $tf; ?>
      <a href="<?= url('admin/' . $tf) ?>" onclick="closeAdminSidebar()"
         class="sb-link<?= $tA ? ' active' : '' ?>">
        <span class="sb-icon"><?= icon($ti, 15) ?></span>
        <span class="sb-label"><?= e($tlabel) ?></span>
      </a>
      <?php endforeach; ?>
    </nav>

    <!-- Footer: user info + logout -->
    <div class="sb-footer">
      <div class="sb-user-row">
        <span class="sb-avatar">
          <?= strtoupper(substr($__user['display_name'] ?? $__user['email'], 0, 1)) ?>
        </span>
        <div class="sb-user-info">
          <div class="sb-user-name">
            <?= e($__user['display_name'] ?? $__user['email']) ?>
          </div>
          <div class="sb-user-role">
            <?= e($__user['role'] === 'superadmin' ? 'Super Admin' : 'Administrator') ?>
          </div>
        </div>
      </div>
      <a href="<?= url('logout.php') ?>" class="sb-logout">
        <span class="sb-icon"><?= icon('log-out', 15) ?></span>
        <span class="sb-label">Sign out</span>
      </a>
    </div>

  </aside><!-- /sidebar -->

  <!-- ══════════════════════════════════════════════════════
       MAIN WRAPPER
       ══════════════════════════════════════════════════════ -->
  <div id="admin-main-wrapper">

    <!-- Topbar -->
    <header class="admin-topbar">
      <div class="admin-topbar-left">
        <button class="admin-hamburger" onclick="openAdminSidebar()" title="Menu"
                id="admin-sidebar-open-btn" aria-label="Open navigation">
          <?= icon('menu', 18) ?>
        </button>
        <h1 class="admin-page-title"><?= e($__pageHeader) ?></h1>
      </div>

      <div class="admin-topbar-right">
        <?php
          require_once __DIR__ . '/branch.php';
          $__bsw = renderBranchSwitcher();
          if ($__bsw) echo $__bsw;
        ?>
        <form method="get" action="<?= url('admin/search.php') ?>" style="display:flex;">
          <input name="q" placeholder="Search…" class="admin-topbar-search" aria-label="Search admin">
        </form>
        <a href="<?= url('index.php') ?>" target="_blank" class="btn btn-ghost btn-sm fs-xs">
          View site ↗
        </a>
        <button onclick="toggleTheme()" class="admin-theme-btn" title="Toggle theme" aria-label="Toggle dark mode">
          <!-- IDs must match head.php toggleTheme() / syncIcons() -->
          <svg id="icon-sun" width="13" height="13" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2" aria-hidden="true" style="display:none;">
            <circle cx="12" cy="12" r="5"/>
            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
          </svg>
          <svg id="icon-moon" width="13" height="13" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
          </svg>
        </button>
      </div>
    </header>

    <!-- Page content injected here -->
    <main id="main-content">
<?php
// Each admin page must include admin-layout-close.php at the end to close tags.
