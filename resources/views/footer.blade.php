<style>
  .footer {
    background-color: #0d1a26;
    color: #fff;
    padding: 40px 20px 20px;
    font-size: 14px;
  }

  .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1300px;
    margin: auto;
    gap: 30px;
  }

  .footer-section {
    flex: 1 1 250px;
    min-width: 220px;
  }

  .footer-section h2 {
    font-size: 16px;
    color: #ffffff;
    margin-bottom: 12px;
  }

  .footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-section ul li {
    margin-bottom: 8px;
  }

  .footer-section ul li a {
    color: #bbbbbb;
    text-decoration: none;
    transition: color 0.3s;
  }

  .footer-section ul li a:hover {
    color: #ffffff;
  }

  .footer-section p i {
    margin-right: 8px;
    color: #888;
  }

  .footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #444;
    color: #aaa;
    margin-top: 30px;
    font-size: 13px;
  }

  /* RESPONSIVE FIXES */
  @media (max-width: 1024px) {
    .footer-container {
      justify-content: center;
    }
  }

@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 10px; /* reduce gap between stacked items */
  }

  .footer-section {
    margin-bottom: 10px;  /* reduce vertical spacing */
    padding: 0 10px;
    height: auto; /* let height adjust naturally */
  }

  /* Also reset margins for children to avoid extra space */
  .footer-section h2 {
    margin-bottom: 8px; /* reduce spacing below titles */
  }
  .footer-section p,
  .footer-section ul {
    margin-top: 0;
    margin-bottom: 8px; /* control paragraph/list spacing */
  }
}


  @media (max-width: 480px) {
    .footer {
      padding: 25px 15px 15px;
    }

    .footer-section {
      padding: 0 10px;
      height: 40px;
    }

    .footer-section h2 {
      font-size: 15px;
    }

    .footer-section ul li {
      margin-bottom: 5px;
    }

    .footer-bottom {
      font-size: 12px;
      padding-top: 15px;
    }
  }
</style>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h2>About Us</h2>
      <p>Your trusted platform for booking billboard space across Ethiopia.</p>
    </div>

    <div class="footer-section">
      <h2>Quick Links</h2>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('billboards') }}">Browse Billboards</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h2>Contact</h2>
      <p><i class="fas fa-envelope"></i>Liyuadinfo@gmail.com</p>
      <p><i class="fas fa-phone"></i> +251 940 127 614</p>
    </div>
  </div>

  <div class="footer-bottom">
    &copy; {{ date('Y') }} BillBoards Ethiopia. All rights reserved.
  </div>
</footer>