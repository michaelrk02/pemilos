<div style="padding-top: 128px; padding-bottom: 128px">
    <div class="w3-card w3-theme-d3 w3-content" style="max-width: 600px">
        <div class="w3-padding">
            <h3>Control Panel</h3>
        </div>
        <div class="w3-white">
            <div class="w3-padding">
                <div class="w3-section">
                    <h3>Admin</h3>
                    <div class="w3-section">
                        <a class="w3-btn w3-red" href="<?php echo site_url('admin/logout'); ?>">Keluar</a>
                        <a class="w3-btn w3-green" href="<?php echo site_url('admin/results'); ?>" target="_blank">Lihat Hasil</a>
                        <a class="w3-btn w3-theme-action" href="<?php echo site_url('display/live_count'); ?>" target="_blank">Live Count</a>
                    </div>
                </div>
                <div class="w3-section">
                    <h3>Token</h3>
                    <?php echo form_open('admin/generate', 'onsubmit="return confirm(\'Apakah anda yakin?\')"'); ?>
                        <div class="w3-section">
                            <div class="w3-panel w3-leftbar w3-pale-blue w3-border-light-blue w3-padding">Terdapat sejumlah <b><?php echo $tokens; ?></b> token di database</div>
                        </div>
                        <div class="w3-section">
                            <label for="count">Jumlah:</label>
                            <input class="w3-input w3-border" id="count" name="count" type="number" placeholder="Masukkan jumlah token yang akan digenerate">
                        </div>
                        <div class="w3-section">
                            <input type="submit" class="w3-btn w3-green" value="Generate">
                            <a class="w3-btn w3-theme-action" href="<?php echo site_url('admin/tokens'); ?>" target="_blank">Print</a>
                            <a class="w3-btn w3-red" href="<?php echo site_url('admin/reset'); ?>?t=<?php echo time(); ?>" onclick="return prompt('Tindakan anda akan mengakibatkan semua token dihapus dan token yang telah digunting menjadi tidak bisa digunakan lagi. Ketik \'saya yakin menghapus semua token\' untuk melanjutkan') === 'saya yakin menghapus semua token'">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
