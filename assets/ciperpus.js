//anggotaAutoComplete (Ajak)
function anggotaAutoComplete() {
    var min_length = 0;
    var keywords = $('#search_anggota').val();
    if (keywords.length >= min_length) {
        $.ajax({
            url: 'http://localhost/PERPUS/peminjaman/anggota_auto_complete',
            type: 'POST',
            data: { keywords: keywords },
            success: function (data) {
                $('#anggota_list').show();
                $('#anggota_list').html(data);
            }
        });
    } else {
        $('#anggota_list').hide();
    }
}

// bukuAutoComplete (Ajak)
function bukuAutoComplete() {
    var min_length = 0;
    var keywords = $('#search_buku').val();
    console.log(keywords);
    if (keywords.length >= min_length) {
        $.ajax({
            url: 'http://localhost/PERPUS/peminjaman/buku_auto_complete',
            type: 'POST',
            data: { keywords: keywords },
            success: function (data) {
                $('#buku_list').show();
                $('#buku_list').html(data);
            }
        });
    } else {
        $('#buku_list').hide();
    }
}

// setItem : Change the value of Input when "clicked"
function setItemAnggota(item) {
    //change input value
    $('#search_anggota').val(item);
    $('#anggota_list').hide();
}

function setItemBuku(item) {
    //change input value
    $('#search_buku').val(item);
    $('#buku_list').hide();
}

// Create input "id_anggota" if not exist
function makeHiddenIdAnggota(nilai) {
    console.log('input id anggota : ' + nilai);
    if ($('#id-anggota').length > 0) {
        $('#id-anggota').attr('value', nilai);
    } else {
        str = '<input type="text" id="id-anggota" name="id_anggota" value="' + nilai + '" />';
        $("#form-peminjaman").append(str);
    }
}

// Create input "id_buku" if not exist
function makeHiddenIdBuku(nilai) {
    console.log('input id buku : ' + nilai);
    if ($('#id-buku').length > 0) {
        $('#id-buku').attr('value', nilai);
    } else {
        str = '<input type="text" id="id-buku" name="id_buku" value="' + nilai + '" />';
        $("#form-peminjaman").append(str);
    }
}