/**
 * Wakalumi Admin Media Uploader
 * 
 * Script universal untuk tombol upload gambar di seluruh halaman admin.
 * Menggunakan wp.media API bawaan WordPress (100% gratis).
 * 
 * Konvensi HTML:
 * - Tombol upload:  class="wkl-upload-btn"  data-target="ID_INPUT" data-preview="ID_PREVIEW"
 * - Tombol hapus:   class="wkl-remove-btn"  data-target="ID_INPUT" data-preview="ID_PREVIEW"
 * - Input URL:      id="ID_INPUT"
 * - Preview gambar: id="ID_PREVIEW" (tag <img>)
 * 
 * @package Wakalumi
 */
jQuery(document).ready(function($) {

    // ─────────────────────────────────────────────
    // UNIVERSAL: Tombol "Unggah Gambar"
    // ─────────────────────────────────────────────
    $(document).on('click', '.wkl-upload-btn', function(e) {
        e.preventDefault();
        var btn         = $(this);
        var targetId    = btn.data('target');
        var previewId   = btn.data('preview');
        var targetInput = $('#' + targetId);
        var previewImg  = $('#' + previewId);
        var removeBtn   = btn.siblings('.wkl-remove-btn');
        if ( ! removeBtn.length ) {
            removeBtn = btn.closest('.wkl-upload-wrap').find('.wkl-remove-btn');
        }

        var frame = wp.media({
            title:    'Pilih atau Unggah Gambar',
            button:   { text: 'Gunakan Gambar Ini' },
            multiple: false,
            library:  { type: 'image' }
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            // Prefer medium size if available, else full URL
            var url = (attachment.sizes && attachment.sizes.medium)
                    ? attachment.sizes.medium.url
                    : attachment.url;

            targetInput.val(attachment.url).trigger('change');

            if ( previewImg.length ) {
                previewImg.attr('src', url).show();
            }
            if ( removeBtn.length ) {
                removeBtn.show();
            }
            // Hide placeholder text if exists
            btn.closest('.wkl-upload-wrap').find('.wkl-placeholder').hide();
        });

        frame.open();
    });

    // ─────────────────────────────────────────────
    // UNIVERSAL: Tombol "Hapus Gambar"
    // ─────────────────────────────────────────────
    $(document).on('click', '.wkl-remove-btn', function(e) {
        e.preventDefault();
        var btn         = $(this);
        var targetId    = btn.data('target');
        var previewId   = btn.data('preview');

        $('#' + targetId).val('');
        $('#' + previewId).attr('src', '').hide();
        btn.hide();
        // Show placeholder text if exists
        btn.closest('.wkl-upload-wrap').find('.wkl-placeholder').show();
    });

    // ─────────────────────────────────────────────
    // REPEATER: Logo Regulasi (Hero & Footer)
    // ─────────────────────────────────────────────
    $(document).on('click', '.wkl-add-logo-row', function(e) {
        e.preventDefault();
        var tableBody = $(this).data('table');
        var tbody     = $('#' + tableBody);
        var count     = tbody.find('tr').length;
        var uid       = 'logo_' + Date.now();

        var row = '<tr style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">' +
            '<td style="text-align:center; font-weight:bold; color:#64748b; width:40px;" class="wkl-logo-num">' + (count + 1) + '</td>' +
            '<td style="width:80px; text-align:center;">' +
                '<div class="wkl-upload-wrap">' +
                    '<img id="prev_' + uid + '" src="" style="max-width:60px; max-height:40px; border-radius:6px; display:none; margin:0 auto;" />' +
                    '<span class="wkl-placeholder" style="display:block; font-size:11px; color:#94a3b8;">Belum ada</span>' +
                    '<button type="button" class="button button-small wkl-upload-btn" data-target="inp_' + uid + '" data-preview="prev_' + uid + '" style="margin-top:4px; font-size:11px;">Pilih</button>' +
                    '<button type="button" class="button-link wkl-remove-btn" data-target="inp_' + uid + '" data-preview="prev_' + uid + '" style="display:none; color:#ef4444; font-size:11px; margin-top:2px;">Hapus</button>' +
                    '<input type="hidden" name="' + tbody.data('name') + '_url[]" id="inp_' + uid + '" value="" />' +
                '</div>' +
            '</td>' +
            '<td>' +
                '<input type="text" name="' + tbody.data('name') + '_label[]" value="" placeholder="Contoh: OJK, LPS, BI..." class="regular-text" style="width:100%;" />' +
            '</td>' +
            '<td style="width:50px; text-align:center;">' +
                '<button type="button" class="button-link-delete wkl-remove-logo-row" style="color:#ef4444;" title="Hapus logo ini">&times;</button>' +
            '</td>' +
        '</tr>';

        tbody.append(row);
        wklRenumberLogos(tbody);
    });

    // Remove a logo row
    $(document).on('click', '.wkl-remove-logo-row', function(e) {
        e.preventDefault();
        var tbody = $(this).closest('tbody');
        if ( tbody.find('tr').length > 1 ) {
            $(this).closest('tr').remove();
            wklRenumberLogos(tbody);
        } else {
            alert('Minimal harus ada 1 logo.');
        }
    });

    function wklRenumberLogos(tbody) {
        tbody.find('tr').each(function(i) {
            $(this).find('.wkl-logo-num').text(i + 1);
        });
    }

});
