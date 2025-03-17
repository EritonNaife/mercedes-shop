<?php
// Template for rendering the multi-step checkout process for Mercedes Shop

// Renders the checkout container with form and order summary
// @param array $cartItems Array of cart items with name, price, quantity, image_url
// @param float $subtotal Total cost of items before shipping and tax
// @param float $shipping Shipping cost
// @param float $tax Tax amount
// @param float $total Final total including all costs
function drawCheckoutContainer($cartItems, $subtotal, $shipping, $tax, $total) {
    ob_start(); ?>
    <main class="checkout-container">
        <div class="checkout-header">
            <h1>Checkout</h1>
            <div class="checkout-steps">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span class="step-name">Information</span>
                </div>
                <div class="step-divider"></div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-name">Shipping</span>
                </div>
                <div class="step-divider"></div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span class="step-name">Payment</span>
                </div>
                <div class="step-divider"></div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span class="step-name">Review</span>
                </div>
            </div>
        </div>

        <div class="checkout-content">
            <div class="checkout-form-container">
                <form id="checkout-form" action="/actions/action_checkout.php" method="POST">
                    <!-- Information Section -->
                    <div class="form-section" id="information-section">
                        <h2>Contact Information</h2>
                        <div class="form-group">
                            <label for="email">Email Address*</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        
                        <h2>Shipping Address</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first-name">First Name*</label>
                                <input type="text" id="first-name" name="first-name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name*</label>
                                <input type="text" id="last-name" name="last-name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Street Address*</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="address2">Apartment, Suite, etc. (optional)</label>
                            <input type="text" id="address2" name="address2">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City*</label>
                                <input type="text" id="city" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State/Province*</label>
                                <select id="state" name="state" required>
                                    <option value="">Select State</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <!-- Add other states here -->
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="zip">ZIP/Postal Code*</label>
                                <input type="text" id="zip" name="zip" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country*</label>
                                <select id="country" name="country" required>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="MX">Mexico</option>
                                    <!-- Add other countries as needed -->
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="save-info" name="save-info">
                            <label for="save-info">Save this information for next time</label>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="shipping-billing" name="shipping-billing" checked>
                            <label for="shipping-billing">Billing address same as shipping</label>
                        </div>
                        
                        <div class="button-row">
                            <a href="/pages/cart.php" class="back-button">Return to cart</a>
                            <button type="button" class="next-button" onclick="nextStep('shipping-section')">Continue to shipping</button>
                        </div>
                    </div>
                    
                    <!-- Shipping Section -->
                    <div class="form-section hidden" id="shipping-section">
                        <h2>Shipping Method</h2>
                        <div class="shipping-options">
                            <div class="shipping-option">
                                <input type="radio" id="standard" name="shipping" value="standard" data-price="5.99" checked>
                                <label for="standard">
                                    <div class="shipping-option-details">
                                        <span class="shipping-name">Standard Shipping</span>
                                        <span class="shipping-duration">3-5 business days</span>
                                    </div>
                                    <span class="shipping-price">$5.99</span>
                                </label>
                            </div>
                            <div class="shipping-option">
                                <input type="radio" id="express" name="shipping" value="express" data-price="12.99">
                                <label for="express">
                                    <div class="shipping-option-details">
                                        <span class="shipping-name">Express Shipping</span>
                                        <span class="shipping-duration">1-2 business days</span>
                                    </div>
                                    <span class="shipping-price">$12.99</span>
                                </label>
                            </div>
                            <div class="shipping-option">
                                <input type="radio" id="overnight" name="shipping" value="overnight" data-price="24.99">
                                <label for="overnight">
                                    <div class="shipping-option-details">
                                        <span class="shipping-name">Overnight Shipping</span>
                                        <span class="shipping-duration">Next business day</span>
                                    </div>
                                    <span class="shipping-price">$24.99</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="button-row">
                            <button type="button" class="back-button" onclick="prevStep('information-section')">Return to information</button>
                            <button type="button" class="next-button" onclick="nextStep('payment-section')">Continue to payment</button>
                        </div>
                    </div>
                    
                    <!-- Payment Section -->
                    <div class="form-section hidden" id="payment-section">
                        <h2>Payment Method</h2>
                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" id="credit-card" name="payment" value="credit-card" checked>
                                <label for="credit-card">Credit Card</label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" id="paypal" name="payment" value="paypal">
                                <label for="paypal">PayPal</label>
                            </div>
                        </div>
                        
                        <div class="credit-card-form">
                            <div class="form-group">
                                <label for="card-number">Card Number*</label>
                                <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="card-name">Name on Card*</label>
                                    <input type="text" id="card-name" name="card-name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiry">Expiration Date*</label>
                                    <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV*</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="button-row">
                            <button type="button" class="back-button" onclick="prevStep('shipping-section')">Return to shipping</button>
                            <button type="button" class="next-button" onclick="nextStep('review-section')">Continue to review</button>
                        </div>
                    </div>
                    
                    <!-- Review Section -->
                    <div class="form-section hidden" id="review-section">
                        <h2>Order Review</h2>
                        <div class="order-summary">
                            <h3>Items</h3>
                            <?php foreach ($cartItems as $item): ?>
                                <div class="order-item">
                                    <div class="item-image">
                                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                    </div>
                                    <div class="item-details">
                                        <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                                        <span class="item-quantity">Qty: <?= $item['quantity'] ?></span>
                                    </div>
                                    <span class="item-price">$<?= number_format($item['price'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="summary-divider"></div>
                            
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping</span>
                                <span>$<?= number_format($shipping, 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Tax</span>
                                <span>$<?= number_format($tax, 2) ?></span>
                            </div>
                            <div class="summary-row total">
                                <span>Total</span>
                                <span>$<?= number_format($total, 2) ?></span>
                            </div>
                        </div>
                        
                        <div class="shipping-summary">
                            <h3>Shipping Information</h3>
                            <p class="summary-address">
                                <span id="review-name">John Doe</span><br>
                                <span id="review-address">123 Main St</span><br>
                                <span id="review-city-state-zip">Anytown, CA 12345</span><br>
                                <span id="review-country">United States</span>
                            </p>
                            <p class="summary-method">
                                <strong>Method:</strong> Standard Shipping (3-5 business days)
                            </p>
                        </div>
                        
                        <div class="payment-summary">
                            <h3>Payment Information</h3>
                            <p><strong>Method:</strong> Credit Card</p>
                            <p><span id="card-last-four">**** **** **** 1234</span></p>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">I agree to the <a href="/terms" class="terms-link">Terms & Conditions</a> and <a href="/privacy" class="terms-link">Privacy Policy</a></label>
                        </div>
                        
                        <div class="button-row">
                            <button type="button" class="back-button" onclick="prevStep('payment-section')">Return to payment</button>
                            <button type="submit" class="place-order-button">Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="order-sidebar">
                <div class="order-summary-container">
                    <h3>Order Summary</h3>
                    <div class="sidebar-items">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="sidebar-item">
                            <div class="sidebar-item-image">
                                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            </div>
                                <div class="sidebar-item-details">
                                    <span class="sidebar-item-name"><?= htmlspecialchars($item['name']) ?></span>
                                    <span class="sidebar-item-quantity">Qty: <?= $item['quantity'] ?></span>
                                    <span class="sidebar-item-price">$<?= number_format($item['price'], 2) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="sidebar-divider"></div>
                    
                    <div class="promo-code">
                        <div class="promo-input">
                            <input type="text" placeholder="Promo Code">
                            <button type="button">Apply</button>
                        </div>
                    </div>
                    
                    <div class="sidebar-divider"></div>
                    
                    <div class="sidebar-totals">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="sidebar-subtotal">$<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span id="sidebar-shipping">$<?= number_format($shipping, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span id="sidebar-tax">$<?= number_format($tax, 2) ?></span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="sidebar-total">$<?= number_format($total, 2) ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="support-section">
                    <h4>Need Help?</h4>
                    <p>Contact our customer service team</p>
                    <a href="mailto:support@mercedesshop.com">support@mercedesshop.com</a>
                    <p>Or call us at: (555) 123-4567</p>
                </div>
                
                <div class="trust-badges">
                    <div class="badge">
                        <span class="badge-icon">🔒</span>
                        <span class="badge-text">Secure Payment</span>
                    </div>
                    <div class="badge">
                        <span class="badge-icon">📦</span>
                        <span class="badge-text">Free Returns</span>
                    </div>
                    <div class="badge">
                        <span class="badge-icon">💯</span>
                        <span class="badge-text">Satisfaction Guaranteed</span>
                    </div>
                </div>
            </div>
        </div>
       <script src="/js/checkout.js"></script>
    </main>
    <?php return ob_get_clean();
}

?>