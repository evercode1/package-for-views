<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script>
    $(document).ready( function () {
        $('#black_hammer_table').DataTable({
            select: false,
            "ajax": {
                "url": "/api/black-hammer",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                { "data": "id"},
                { "data": "black_hammer_name",
                    "render": function(data,type,row,meta) {
                        return '<a href="/black-hammer/'+row.id+'">'+data+'</a>';
                    }
                },
                { "data": "created_at",
                    "render": function ( data, type, full, meta ) {
                        // instantiate a moment object and hand it the string date
                        var d = moment(data);
                        var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
                        var day = d.date()  < 10 ? "0" + (d.date()): d.date();
                        return month + "/" + day + "/" + d.year();
                    }
                },
                {"defaultContent": "null", "render": function(data,type,row,meta) {
                    return '<a href="/black-hammer/'+row.id+'/edit">'+ '<button>Edit</button>' + '</a>';
                }
                }
            ]
        });
    } );
</script>