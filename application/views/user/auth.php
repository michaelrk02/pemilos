<div style="padding-top: 96px; padding-bottom: 96px;">
    <div class="w3-card w3-theme-d3 w3-content" style="max-width: 600px">
        <div class="w3-padding">
            <h3>Login Panitia</h3>
        </div>
        <div class="w3-padding-large w3-white">
            <?php echo form_open('user/auth'); ?>
                <div class="w3-section">
                    <?php if (isset($status)) { status_message($status); } ?>
                </div>
                <div class="w3-section">
                    <label for="password">Kata sandi:</label>
                    <input type="password" class="w3-input w3-border" id="password" name="password" placeholder="Masukkan password panitia">
                </div>
                <div class="w3-section">
                    <input type="submit" class="w3-btn w3-theme-action" value="Masuk">
                </div>
            </form>
        </div>
    </div>
</div>
