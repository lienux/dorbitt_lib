<?= $this->extend('admin/layout/index') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-editor/editor.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button class="btn btn-sm btn-primary" id="new">New</button>
            <button class="btn btn-sm btn-warning disabled" id="edit">Edit</button>
            <button class="btn btn-sm btn-danger disabled" id="delete">Delete</button>
            <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Logo</th>
                        <th>Content</th>
                        <th>File1</th>
                        <th>File2</th>
                        <th>File3</th>
                        <th>File4</th>
                    </tr>
                </thead>
            </table>

        </div>
        <!-- /.card-body -->
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/datatables-editor/dataTables.editor.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        // var table = $('#myTable').DataTable();

        // var table = $('#myTable').DataTable( {
        const table = new DataTable('#myTable',{
            ajax: '<?=base_url()?>admin/activity/find_all',
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: [
                // {
                //     text: 'New',
                //     action: function ( e, dt, node, config ) {
                //         // alert( 'Button activated' );
                //         window.location.href = "<?=base_url()?>admin/activity/new";
                //     }
                // },
                // // {
                // //     text: 'Edit',
                // //     action: function ( e, dt, node, config ) {
                // //         // alert( 'Button activated' );
                // //         alert(e)
                // //         // window.location.href = "<?=base_url()?>admin/activity/new";
                // //     }
                // // },
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            columns: [
                { data: 'id' },
                { data: 'subject' },
                { 
                    data: 'logo',
                    // render: function (data, type) {
                    //     // if (type === 'display') {
                    //     //     let link = 'http://datatables.net';
         
                    //     //     if (data[0] < 'H') {
                    //     //         link = 'http://cloudtables.com';
                    //     //     }
                    //     //     else if (data[0] < 'S') {
                    //     //         link = 'http://editor.datatables.net';
                    //     //     }
         
                    //     //     return '<a href="' + link + '">' + data + '</a>';
                    //     // }

                    //     var source = '<?base_url()?>images/'+data;

                    //     // res = '<a href="#" title="Click for show image"><i class="far fa-eye"></i></a>';
                    //     res = '<button type="button" class="btn btn-xs btn-secondary">Click</butoon>';
         
                    //     return res;
                    // }
                },
                { data: 'content' },
                { data: 'file1' },
                { data: 'file2' },
                { data: 'file3' },
                { data: 'file4' },
                // {
                //     data: null,
                //     className: 'dt-center editor-edit',
                //     defaultContent: '<i class="fa fa-pencil"/>',
                //     orderable: false
                // },
                // {
                //     data: null,
                //     className: 'dt-center editor-delete',
                //     defaultContent: '<i class="fa fa-trash"/>',
                //     orderable: false
                // }
            ],
            columnDefs: [
                {
                    className: 'dtr-control',
                    orderable: false,
                    targets:   -1
                },
                {
                    target: [0],
                    visible: false
                },
                { 
                    responsivePriority: 0, 
                    targets: [1,4,5,6,7] 
                },
            ],
            dom: 'Bfrtip'
        });

        // table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

        // $(function () {
            // table.buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
        //     $("#myTable").DataTable({
        //         // "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": [
        //             // {
        //             //     text: 'New',
        //             //     action: function ( e, dt, node, config ) {
        //             //         // alert( 'Button activated' );
        //             //         window.location.href = "<?=base_url()?>admin/activity/new";
        //             //     }
        //             // },
        //             {
        //                 text: 'Edit',
        //                 action: function ( e, dt, node, config ) {
        //                     // alert( 'Button activated' );
        //                     alert(e)
        //                     // window.location.href = "<?=base_url()?>admin/activity/new";
        //                 }
        //             },
        //             "copy", "csv", "excel", "pdf", "print", "colvis"
        //         ],
        //         // "columnDefs": [
        //         //     {
        //         //         data: null,
        //         //         defaultContent: '<a href="#" id="edit" class="edit"><i class="fas fa-edit"></i></a>',
        //         //         targets: 1
        //         //     },
        //         //     {
        //         //         "targets": [ 2 ],
        //         //         "visible": false,
        //         //         "searchable": false
        //         //     }
        //         // ],
        //     }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
        // });

        // table.buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
        // .buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');
        // new $.fn.dataTable.buttons( table, {
        //     buttons: [
        //         {
        //             text: 'New',
        //             action: function ( e, dt, node, config ) {
        //                 // alert( 'Button activated' );
        //                 window.location.href = "<?=base_url()?>admin/activity/new";
        //             }
        //         },
        //         // {
        //         //     text: 'Edit',
        //         //     action: function ( e, dt, node, config ) {
        //         //         // alert( 'Button activated' );
        //         //         alert(e)
        //         //         // window.location.href = "<?=base_url()?>admin/activity/new";
        //         //     }
        //         // },
        //         "copy", "csv", "excel", "pdf", "print", "colvis"
        //     ]
        // } );
 
        table.on('click', 'tbody tr', function(e) {
            dataRow = table.row( this ).data();
            console.log(dataRow)

            let classList = e.currentTarget.classList;
            // alert(classList)
         
            if (classList.contains('selected')) {
                classList.remove('selected');
                $('#edit, #delete').addClass('disabled');
            }
            else {
                table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
                $('#edit, #delete').removeClass('disabled');
            }
        });
         
        document.querySelector('#delete').addEventListener('click', function () {
            table.row('.selected').remove().draw(false);
        });

        document.querySelector('#edit').addEventListener('click', function () {
            console.log(dataRow)
            const id = dataRow.id;
            window.location.href = "<?=base_url()?>admin/activity/edit/"+id;
            // table.row('.selected').remove().draw(false);
            // dataRow2 = table.row('.selected').data();
        });

        $('#new').on('click', function() {
            window.location.href = "<?=base_url()?>admin/activity/new";
        })

        // var table = $('#myTable').DataTable();
 
        // new $.fn.dataTable.Buttons( table, {
        //     buttons: [
        //         'copy', 'excel', 'pdf'
        //     ]
        // } );


        // $(function () {
        //     $("#myTable").DataTable({
        //         "responsive": true, "lengthChange": false, "autoWidth": false,
        //         "buttons": [
        //             // // {
        //             // //     text: 'New',
        //             // //     action: function ( e, dt, node, config ) {
        //             // //         // alert( 'Button activated' );
        //             // //         window.location.href = "<?=base_url()?>admin/activity/new";
        //             // //     }
        //             // // },
        //             // {
        //             //     text: 'Edit',
        //             //     action: function ( e, dt, node, config ) {
        //             //         // alert( 'Button activated' );
        //             //         alert(e)
        //             //         // window.location.href = "<?=base_url()?>admin/activity/new";
        //             //     }
        //             // },
        //             "copy", "csv", "excel", "pdf", "print", "colvis"
        //         ]
        //         // "columnDefs": [
        //         //     {
        //         //         data: null,
        //         //         defaultContent: '<a href="#" id="edit" class="edit"><i class="fas fa-edit"></i></a>',
        //         //         targets: 1
        //         //     },
        //         //     {
        //         //         "targets": [ 2 ],
        //         //         "visible": false,
        //         //         "searchable": false
        //         //     }
        //         // ],
        //     }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');


        //     // var myTable = $('#myTable').DataTable();

        //     // // myTable.on('click', 'tbody tr', function (e) {
        //     // //     // let data = myTable.row(e.target.closest('tr')).data();
             
        //     // //     // alert(data[0] + "'s salary is: " + data[5]);
        //     // //     // alert(data[3])
        //     // //     // console.log( myTable.row( this ).data() );
        //     // //     console.log(e)
        //     // // });
 
        //     // $('#myTable').on( 'click', 'tbody tr', function () {
        //     //     dataRow = myTable.row( this ).data();
        //     //     window.location.href = "<?=base_url()?>admin/activity/edit/"+dataRow[2];
        //     //     // alert('OK')
        //     //     // myTable.row( this ).edit( {
        //     //     //     buttons: [
        //     //     //         { 
        //     //     //             label: 'Cancel', 
        //     //     //             fn: function () { this.close(); } },
        //     //     //         'Edit'
        //     //     //     ]
        //     //     // } );
        //     //     // alert(e.toString())
        //     //     console.log(dataRow)
        //     //     // console.log( myTable.row( this ).data() );
        //     // });

        //     // // $('#myTable').on( 'click', 'tbody tr', function () {
        //     // //     myTable.row( this ).edit( {
        //     // //         buttons: [
        //     // //             { label: 'Cancel', fn: function () { this.close(); } },
        //     // //             'Edit'
        //     // //         ]
        //     // //     } );
        //     // // } );
        // });
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
    <!-- <script type="module" src="<?=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
    <!-- <script type="module" src="<?=base_url();?>js/pages/dashboard/index.js"></script> -->
<?= $this->endSection() ?>