<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Game - Mobile legend</title>
    <link rel="stylesheet" href="{{ asset('css/stylestopup.css') }}">

</head>
<body>


    <!-- Main Content -->
    <div class="container">
    <a href="{{ route('index') }}" class="home-button">Home</a>
    <div class="game-title-box">
    <span class="game-title-text">FC24</span>
</div>

        <!-- Step 1: Riot ID -->
        <div class="step riot-id-section">
            <div class="step-number">1</div>
            <div class="step-content">
                <label for="riot-id">ID FC24</label>
                <input type="text" id="riot-id" name="riot-id" placeholder="Masukkan ID" required>
            </div>
        </div>

 <!-- Step 2: Paket Top-Up -->
 <div class="step">
    <div class="step-number">2</div>
    <div class="step-content">
        <label>Pilih Paket Top Up:</label>
        <div class="packages">
            <div class="package-card">
                <input type="radio" id="package1" name="amount" value="50000" data-description="1000 Diamonds">
                <label for="package1">
                    <h4>1000 Diamonds</h4>
                    <p>Rp 50,000</p>
                </label>
            </div>
            <div class="package-card">
                <input type="radio" id="package2" name="amount" value="120000" data-description="2500 Diamonds">
                <label for="package2">
                    <h4>2500 Diamonds</h4>
                    <p>Rp 120,000</p>
                </label>
            </div>
            <div class="package-card">
                <input type="radio" id="package3" name="amount" value="220000" data-description="5000 Diamonds">
                <label for="package3">
                    <h4>5000 Diamonds</h4>
                    <p>Rp 220,000</p>
                </label>
            </div>
            <div class="package-card">
                <input type="radio" id="package4" name="amount" value="320000" data-description="7000 Diamonds">
                <label for="package4">
                    <h4>7000 Diamonds</h4>
                    <p>Rp 320,000</p>
                </label>
            </div>
            <div class="package-card">
                <input type="radio" id="package8" name="amount" value="430000" data-description="10000 Diamonds">
                <label for="package8">
                    <h4>10000 Diamonds</h4>
                    <p>Rp 430,000</p>
                </label>
            </div>
            <div class="package-card">
                <input type="radio" id="package5" name="amount" value="9999999999" data-description="10000000 Diamonds">
                <label for="package5">
                    <h4>9999999999</h4>
                    <p>Rp 10,000,000</p>
                </label>
            </div>
        </div>
    </div>
</div>

        <!-- Step 3: Metode Pembayaran -->
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-content">
                <label>Pilih Metode Pembayaran:</label>
                <div class="payment-methods">
                    <div class="payment-method">
                        <input type="radio" id="dana" name="payment-method" value="Dana" data-account="085123456789">
                        <label for="dana">
                            <img src="assets/dana.jpeg" alt="Dana">
                        </label>
                    </div>
                    <div class="payment-method">
                        <input type="radio" id="bca" name="payment-method" value="BCA" data-account="123-456-789">
                        <label for="bca">
                            <img src="assets/Logo-BCA.jpg" alt="BCA">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="step payment-details">
            <div class="step-number">4</div>
            <div class="step-content">
                <h2>Detail Pembayaran</h2>
                <p><strong>ID:</strong> <span id="display-riot-id">-</span></p>
                <p><strong>Item:</strong> <span id="display-item">-</span></p>
                <p><strong>Metode Pembayaran:</strong> <span id="display-payment-method">-</span></p>
                <p><strong>No. Rekening:</strong> <span id="display-account-number">-</span></p>
                <p><strong>Total:</strong> <span id="display-total">Rp 0</span></p>
        
                <!-- Input for Konfirmasi -->
                <div class="confirmation-input">
                    <label for="payment-proof">Unggah Bukti Pembayaran:</label>
                    <input type="file" id="payment-proof" accept="image/*">
                </div>
        
                <!-- Submit Button -->
                <button class="confirm-btn" onclick="submitConfirmation()">Konfirmasi Pembelian</button>
            </div>
        </div>
        
    </div>
    

    <!-- JavaScript -->
    <script>
        const riotIdInput = document.getElementById('riot-id');
        const packageInputs = document.querySelectorAll('input[name="amount"]');
        const paymentInputs = document.querySelectorAll('input[name="payment-method"]');
        const displayRiotId = document.getElementById('display-riot-id');
        const displayItem = document.getElementById('display-item');
        const displayPaymentMethod = document.getElementById('display-payment-method');
        const displayAccountNumber = document.getElementById('display-account-number');
        const displayTotal = document.getElementById('display-total');

        function updatePaymentDetails() {
            // Update Riot ID
            displayRiotId.textContent = riotIdInput.value || '-';

            // Update Selected Package
            const selectedPackage = document.querySelector('input[name="amount"]:checked');
            if (selectedPackage) {
                displayItem.textContent = selectedPackage.dataset.description;
                displayTotal.textContent = `Rp ${parseInt(selectedPackage.value).toLocaleString('id-ID')}`;
            }

            // Update Selected Payment Method
            const selectedPayment = document.querySelector('input[name="payment-method"]:checked');
            if (selectedPayment) {
                displayPaymentMethod.textContent = selectedPayment.value;
                displayAccountNumber.textContent = selectedPayment.dataset.account;
            }
        }

        // Event Listeners
        riotIdInput.addEventListener('input', updatePaymentDetails);
        packageInputs.forEach(input => input.addEventListener('change', updatePaymentDetails));
        paymentInputs.forEach(input => input.addEventListener('change', updatePaymentDetails));
    </script>




</body>
</html>
