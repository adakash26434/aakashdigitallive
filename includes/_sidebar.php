<?php
/**
 * ============================================================
 *  includes/_sidebar.php — Shared sidebar renderer
 *  Used by admin-layout.php and portal-layout.php.
 * ============================================================
 */

if (!function_exists('icon')) {
    require_once __DIR__ . '/helpers.php';
}

function renderSidebar(array $cfg): void {
    $id          = $cfg['id']          ?? 'app-sidebar';
    $theme       = $cfg['theme']       ?? 'light';
    $isDark      = $theme === 'dark';
    $brand       = $cfg['brand']       ?? ['name' => 'Menu', 'href' => '#'];
    $user        = $cfg['user']        ?? [];
    $cur         = $cfg['currentPath'] ?? '';
    $direct      = $cfg['directLinks'] ?? [];
    $groups      = $cfg['groups']      ?? [];
    $logoutHref  = $cfg['logoutHref']  ?? '#';
    $urlPrefix   = $cfg['urlPrefix']   ?? '';
    $closeFn     = $cfg['closeJsFn']   ?? 'closeAppSidebar';
    $footerExtra = $cfg['footerExtra'] ?? '';

    /* ── colour tokens ─────────────────────────────────── */
    $bg         = $isDark ? '#0f172a'                    : 'var(--card)';
    $border     = $isDark ? 'rgba(241,245,249,0.08)'     : 'var(--border)';
    $linkClr    = $isDark ? 'rgba(241,245,249,0.65)'     : 'var(--foreground)';
    $hoverBg    = $isDark ? 'rgba(241,245,249,0.07)'     : 'var(--muted)';
    $activeBg   = $isDark ? 'rgba(59,130,246,0.22)'      : 'var(--primary-light)';
    $activeFg   = $isDark ? '#60a5fa'                    : 'var(--primary)';
    $brandClr   = $isDark ? 'rgba(241,245,249,0.9)'      : 'var(--foreground)';
    $mutedClr   = $isDark ? 'rgba(241,245,249,0.38)'     : 'var(--muted-foreground)';
    $grpHdrClr  = $isDark ? 'rgba(241,245,249,0.35)'     : 'var(--muted-foreground)';

    /* ── shared inline style fragments ─────────────────── */
    $linkBase  = "display:flex;align-items:center;gap:0.625rem;padding:0.45rem 0.75rem;"
               . "border-radius:0.5rem;margin-bottom:0.1rem;text-decoration:none;"
               . "font-size:0.8125rem;font-weight:500;transition:background 0.12s,color 0.12s;"
               . "cursor:pointer;";
    $iconWrap  = "display:inline-flex;align-items:center;justify-content:center;"
               . "width:1.125rem;height:1.125rem;flex-shrink:0;";
    ?>
<style>
/* ── Sidebar scrollbar thin ────────────────── */
#<?= htmlspecialchars($id) ?> nav::-webkit-scrollbar{width:4px;}
#<?= htmlspecialchars($id) ?> nav::-webkit-scrollbar-track{background:transparent;}
#<?= htmlspecialchars($id) ?> nav::-webkit-scrollbar-thumb{background:<?= $border ?>;border-radius:9999px;}
/* ── Sidebar close btn hidden by default, flex on mobile ── */
#<?= htmlspecialchars($id) ?> .sb-close-btn{display:none;}
@media(max-width:900px){#<?= htmlspecialchars($id) ?> .sb-close-btn{display:flex;}}
/* ── Group toggle arrow smooth ────────────── */
.sb-chevron{transition:transform 0.2s ease;}
.sb-chevron.open{transform:rotate(180deg);}
</style>

<aside id="<?= htmlspecialchars($id) ?>"
       class="app-sidebar<?= $isDark ? ' sidebar-dark' : ' sidebar-light' ?>"
       style="width:15rem;flex-shrink:0;display:flex;flex-direction:column;
              background:<?= $bg ?>;border-right:1px solid <?= $border ?>;
              overflow:hidden;transition:transform 0.25s ease;">

  <!-- Brand ─────────────────────────────────────── -->
  <div style="padding:1rem 1.125rem;border-bottom:1px solid <?= $border ?>;
              display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">
    <a href="<?= htmlspecialchars($brand['href']) ?>"
       style="display:flex;align-items:center;gap:0.625rem;font-family:var(--font-display);
              font-weight:700;font-size:0.9375rem;color:<?= $brandClr ?>;text-decoration:none;min-width:0;">
      <span style="display:grid;place-items:center;width:2rem;height:2rem;border-radius:0.5rem;
                   background:var(--gradient-primary);color:#fff;font-weight:800;font-size:0.6875rem;flex-shrink:0;">ST</span>
      <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($brand['name']) ?></span>
    </a>
    <button type="button" onclick="<?= htmlspecialchars($closeFn) ?>()"
            class="sb-close-btn"
            title="Close menu"
            style="align-items:center;justify-content:center;width:1.875rem;height:1.875rem;
                   border-radius:0.375rem;border:none;background:<?= $hoverBg ?>;
                   cursor:pointer;color:<?= $linkClr ?>;flex-shrink:0;">
      <?= icon('x', 16) ?>
    </button>
  </div>

  <!-- Nav ────────────────────────────────────────── -->
  <nav style="flex:1;padding:0.5rem 0.625rem;overflow-y:auto;overflow-x:hidden;">

    <?php foreach ($direct as $item):
        $active = $cur === $item['file'];
        $href   = htmlspecialchars((defined('SITE_URL') ? SITE_URL . '/' : '') . $urlPrefix . $item['file']);
        $badge  = $item['badge'] ?? null;
    ?>
    <a href="<?= $href ?>" onclick="<?= htmlspecialchars($closeFn) ?>()"
       class="sidebar-link<?= $active ? ' active' : '' ?>"
       style="<?= $linkBase ?>color:<?= $active ? $activeFg : $linkClr ?>;
              background:<?= $active ? $activeBg : 'transparent' ?>;"
       onmouseover="if(!this.classList.contains('active')){this.style.background='<?= $hoverBg ?>';this.style.color='<?= $isDark ? '#f1f5f9' : 'var(--foreground)' ?>';}"
       onmouseout="if(!this.classList.contains('active')){this.style.background='transparent';this.style.color='<?= $linkClr ?>';}">
      <span style="<?= $iconWrap ?>"><?= icon($item['icon'], 15) ?></span>
      <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($item['label']) ?></span>
      <?php if ($badge): ?>
      <span style="background:#ef4444;color:#fff;font-size:0.625rem;font-weight:700;
                   padding:0.05rem 0.4rem;border-radius:9999px;min-width:18px;text-align:center;flex-shrink:0;">
        <?= htmlspecialchars((string)$badge) ?>
      </span>
      <?php endif; ?>
    </a>
    <?php endforeach; ?>

    <?php if (!empty($groups)): ?>
    <div style="height:1px;background:<?= $border ?>;margin:0.5rem 0.25rem;"></div>

    <?php
    $activeGroup = null;
    foreach ($groups as $gLabel => $gItems) {
        foreach ($gItems as $gi) {
            if (($gi['file'] ?? '') === $cur) { $activeGroup = $gLabel; break 2; }
        }
    }
    foreach ($groups as $gLabel => $gItems):
        $isActive = $activeGroup === $gLabel;
        $gid = 'nav-grp-' . strtolower(preg_replace('/\W+/', '-', $gLabel));
    ?>
    <div style="margin-bottom:0.125rem;">
      <!-- Group header button -->
      <button type="button" onclick="toggleNavGroup('<?= $gid ?>')"
        style="width:100%;display:flex;align-items:center;gap:0.625rem;padding:0.4rem 0.75rem;
               border-radius:0.5rem;border:none;background:transparent;color:<?= $grpHdrClr ?>;
               cursor:pointer;text-align:left;font-size:0.6875rem;font-weight:700;
               text-transform:uppercase;letter-spacing:0.06em;transition:color 0.12s;"
        onmouseover="this.style.color='<?= $linkClr ?>'"
        onmouseout="this.style.color='<?= $grpHdrClr ?>'">
        <span style="flex:1;"><?= htmlspecialchars($gLabel) ?></span>
        <span class="sb-chevron<?= $isActive ? ' open' : '' ?>" id="<?= $gid ?>-chevron">
          <?= icon('chevron-down', 12) ?>
        </span>
      </button>

      <!-- Group items -->
      <div id="<?= $gid ?>" style="overflow:hidden;padding-left:0.375rem;<?= $isActive ? '' : 'display:none;' ?>">
        <?php foreach ($gItems as $gi):
            $active = $cur === ($gi['file'] ?? '');
            $href = htmlspecialchars((defined('SITE_URL') ? SITE_URL . '/' : '') . $urlPrefix . $gi['file']);
        ?>
        <a href="<?= $href ?>" onclick="<?= htmlspecialchars($closeFn) ?>()"
           class="sidebar-link<?= $active ? ' active' : '' ?>"
           style="<?= $linkBase ?>font-size:0.7875rem;
                  color:<?= $active ? $activeFg : $linkClr ?>;
                  background:<?= $active ? $activeBg : 'transparent' ?>;"
           onmouseover="if(!this.classList.contains('active')){this.style.background='<?= $hoverBg ?>';this.style.color='<?= $isDark ? '#f1f5f9' : 'var(--foreground)' ?>';}"
           onmouseout="if(!this.classList.contains('active')){this.style.background='transparent';this.style.color='<?= $linkClr ?>';}">
          <span style="<?= $iconWrap ?>"><?= icon($gi['icon'] ?? 'circle', 14) ?></span>
          <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($gi['label']) ?></span>
          <?php if (!empty($gi['badge'])): ?>
          <span style="background:#ef4444;color:#fff;font-size:0.625rem;font-weight:700;
                       padding:0.05rem 0.4rem;border-radius:9999px;min-width:16px;text-align:center;flex-shrink:0;">
            <?= htmlspecialchars((string)$gi['badge']) ?>
          </span>
          <?php endif; ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </nav>

  <!-- Footer ─────────────────────────────────────── -->
  <div style="padding:0.625rem;border-top:1px solid <?= $border ?>;flex-shrink:0;">
    <?= $footerExtra ?>
    <?php if (!empty($user)): ?>
    <div style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 0.75rem;margin-bottom:0.25rem;">
      <span style="width:2rem;height:2rem;border-radius:9999px;background:var(--gradient-primary);
                   display:grid;place-items:center;font-size:0.75rem;font-weight:700;color:#fff;flex-shrink:0;">
        <?= strtoupper(substr($user['display_name'] ?? $user['email'] ?? '?', 0, 1)) ?>
      </span>
      <div style="min-width:0;flex:1;">
        <div style="font-size:0.75rem;font-weight:600;color:<?= $isDark ? 'rgba(241,245,249,0.85)' : 'var(--foreground)' ?>;
                    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
          <?= htmlspecialchars($user['display_name'] ?? $user['email'] ?? '') ?>
        </div>
        <div style="font-size:0.6875rem;color:<?= $mutedClr ?>;">
          <?= htmlspecialchars(ucfirst($user['role'] ?? 'Client')) ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <a href="<?= htmlspecialchars($logoutHref) ?>"
       style="display:flex;align-items:center;gap:0.625rem;padding:0.45rem 0.75rem;
              border-radius:0.5rem;font-size:0.8125rem;font-weight:500;color:#ef4444;
              text-decoration:none;transition:background 0.12s;"
       onmouseover="this.style.background='<?= $isDark ? 'rgba(239,68,68,0.14)' : 'var(--danger-soft)' ?>'"
       onmouseout="this.style.background='transparent'">
      <span style="<?= $iconWrap ?>"><?= icon('log-out', 15) ?></span>
      <span>Sign out</span>
    </a>
  </div>
</aside>

<script>
window.toggleNavGroup = window.toggleNavGroup || function (id) {
  var el   = document.getElementById(id);
  var chev = document.getElementById(id + '-chevron');
  if (!el) return;
  var isOpen = el.style.display !== 'none';
  el.style.display = isOpen ? 'none' : 'block';
  if (chev) chev.classList.toggle('open', !isOpen);
  try {
    var st = JSON.parse(localStorage.getItem('st-nav-groups') || '{}');
    st[id] = !isOpen;
    localStorage.setItem('st-nav-groups', JSON.stringify(st));
  } catch (e) {}
};
/* Re-run lucide after any group is opened so icons inside render */
(function () {
  var orig = window.toggleNavGroup;
  window.toggleNavGroup = function (id) {
    orig(id);
    if (window.lucide) { try { lucide.createIcons(); } catch(e){} }
  };
}());
</script>
<?php
}
