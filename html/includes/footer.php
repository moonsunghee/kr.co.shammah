<!-- Footer -->
<div class="sitemap">
  <nav class="sitemap-inner">
    <ul class="sitemap-layout">
      <li class="sitemap__block">
        <h5><a href="/">삼마디자인</a></h5>
        <ul>
          <li><a href="">설립목적</a></li>
          <li><a href="">견적문의</a></li>
          <li><a href="">삼마교육</a></li>
          <li><a href="">포트폴리오</a></li>
        </ul>
      </li>
      <li class="sitemap__block">
        <h5><a href="/freelancer.php">파트너안내</a></h5>
        <ul>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
        </ul>
      </li>
      <li class="sitemap__block">
        <h5><a href="/portfolio.php">포트폴리오</a></h5>
        <ul>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
        </ul>
      </li>
      <li class="sitemap__block">
        <h5><a href="/lesson.php">교육훈련</a></h5>
        <ul>
          <li><a href="">AI교육</a></li>
          <li><a href="">디자이너양성</a></li>
          <li><a href="">개발자양성</a></li>
          <li><a href="">업무/보조</a></li>
        </ul>
      </li>
      <li class="sitemap__block">
        <h5><a href="/quote.php">견적요청</a></h5>
        <ul>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
          <li><a href="">text</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>

<div class="site-footer">
  <footer class="footer">
    <h1 class="logo">
      <a href="/">
        <img src="/images/logo/shammah-logo.svg" alt="SHAMMAH">
        <br>
        SHAM<span>MAH</span></a>
    </h1>
    <address class="footer__info">
      <strong>삼마디자인</strong> | 대표: 문성희 | 사업자등록번호: 100-23-4567 | 제주특별자치도 제주시 첨단로 10000 | T. 010-8843-1187 | E. shammah.moon@gamil.com
    </address>

    <div class="footer__copy">
      <p>&copy; <?php echo date('Y'); ?> <?php echo h(get_content($pdo, 'footer_company', '삼마디자인')); ?>. All rights
        reserved.</p>
    </div>
  </footer>
</div>

<!-- /Footer -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="/js/main.js"></script>
<?php if (isset($pageJS)): ?>
  <script src="/js/pages/<?php echo h($pageJS); ?>"></script>
<?php endif; ?>
</body>

</html>