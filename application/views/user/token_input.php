<div style="padding-top: 128px; padding-bottom: 128px">
    <div class="w3-card w3-theme-d3 w3-content" style="max-width: 600px">
        <div class="w3-padding">
            <h3>Masukkan Token</h3>
        </div>
        <div id="token-form" class="w3-padding-large w3-white">
            <?php echo form_open('user/token_input'); ?>
                <div class="w3-section">
                    <?php if (isset($status)) { status_message($status); } ?>
                </div>
                <div class="w3-section">
                    <label for="token">Token:</label>
                    <input v-bind:type="tokenInputType" class="w3-input w3-border" id="token" name="token" placeholder="Masukkan token yang telah diberikan">
                    <div>
                        <input v-model="showToken" type="checkbox" class="w3-check">
                        &nbsp;Perlihatkan token
                    </div>
                </div>
                <div class="w3-section">
                    <input type="submit" class="w3-btn w3-theme-action" value="Kirim">
                </div>
            </form>
        </div>
    </div>
</div>

<script>

var tokenForm = new Vue({
    el: '#token-form',
    data: {
        showToken: false
    },
    computed: {
        tokenInputType: function() {
            return this.showToken ? 'text' : 'password';
        }
    }
});

</script>
