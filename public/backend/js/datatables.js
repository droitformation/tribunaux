// -------------------------------
// Initialize Data Tables
// -------------------------------

$(document).ready(function() {

    var init = function() {

        var api    = this.api();
        var column = api.column(3);

        var select = $('<select class="form-control input-sm"><option value="">Filtrer par volume</option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );

                column.search( val ? '^'+val+'$' : '', true, false ).draw();
            } );

        column.data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        });

    };

    var langues = {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de _START_ &agrave; _END_ sur _TOTAL_ lignes",
        infoEmpty:      "Affichage de 0 &agrave; 0 sur 0 lignes",
        infoFiltered:   "(filtr&eacute; de _MAX_ lignes au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    };

    $('#arrets').DataTable({
        initComplete: init,
        language    : langues,
        pagingType  : 'simple'
    });

    $('#generic').DataTable({
        language: langues,
        pagingType: 'simple'
    });

    $('.dataTables_filter input').addClass('form-control').attr('placeholder','Recherche...');
    $('.dataTables_length select').addClass('form-control');
});