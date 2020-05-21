<div style="padding-top: 128px; padding-bottom: 128px">
    <div class="w3-card w3-theme-d3 w3-content" style="max-width: 600px">
        <div class="w3-padding">
            <h3>Masuk Sebagai Administrator</h3>
        </div>
        <div class="w3-white">
            <div class="w3-padding">
                <?php echo form_open('admin/auth'); ?>
                    <div class="w3-section">
                        <?php if (isset($status)) { status_message($status); } ?>
                    </div>
                    <div class="w3-section">
                        <label for="password">Kata sandi:</label>
                        <input class="w3-input w3-border" id="password" name="password" type="password" placeholder="Masukkan password">
                    </div>
                    <div class="w3-section">
                        <input type="submit" class="w3-btn w3-theme-action" value="Masuk">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
