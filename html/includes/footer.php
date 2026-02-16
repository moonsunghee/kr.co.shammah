</main>
<!-- /main -->

<!-- Footer -->
<footer class="footer">
  <div class="footer__inner">
    <div class="footer__brand">
      <a href="/" class="footer__logo">SHAMMAH</a>
      <p class="footer__tagline">웹기획 · 디자인 · 개발 · IT교육</p>
    </div>

    <nav class="footer__nav">
      <ul>
        <li><a href="/freelancer.php">프리랜서안내</a></li>
        <li><a href="/portfolio.php">포트폴리오</a></li>
        <li><a href="/lesson.php">교육</a></li>
        <li><a href="/quote.php">견적요청</a></li>
      </ul>
    </nav>

    <address class="footer__info">
      <strong><?php echo h(get_content($pdo, 'footer_company', '삼마디자인')); ?></strong><br>
      대표: <?php echo h(get_content($pdo, 'footer_ceo', '')); ?> |
      사업자등록번호: <?php echo h(get_content($pdo, 'footer_biznum', '')); ?><br>
      <?php echo h(get_content($pdo, 'footer_address', '')); ?><br>
      T. <?php echo h(get_content($pdo, 'footer_phone', '')); ?> |
      E. <?php echo h(get_content($pdo, 'footer_email', '')); ?>
    </address>
  </div>

  <div class="footer__copy">
    <p>&copy; <?php echo date('Y'); ?> <?php echo h(get_content($pdo, 'footer_company', '삼마디자인')); ?>. All rights reserved.</p>
  </div>
</footer>
<!-- /Footer -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/js/main.js"></script>
<?php if (isset($pageJS)): ?>
<script src="/js/pages/<?php echo h($pageJS); ?>"></script>
<?php endif; ?>
</body>
</html>
