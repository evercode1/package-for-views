@extends('layouts.master')
@section('css')
    <style>
        [v-cloak] {
            display:none;
        }

        th.active .arrow {
            opacity: 1;
        }

        .arrow {
            display: inline-block;
            vertical-align: middle;
            width: 0;
            height: 0;
            margin-left: 5px;
            opacity: 0.66;
        }

        .arrow.asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid black;
        }

        .arrow.dsc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid black;
        }
        table thead tr th {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

<ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/orange'>Orange</a></li>
        </ol>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">

                     <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{active: sortKey == key}">
                @{{key | capitalize}}
                <span class="arrow"
                      :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="
        row in data
        | filterBy filterKey
        | orderBy sortKey sortOrders[sortKey]">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href="/orange/@{{row.Id}}">@{{row.Name}}</a>
                </td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href="/orange/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

            </section>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click.prevent="prevpage" >prev</a></li>
                    <li v-for="page in pages" v-bind:class="{'active': checkpage(page)}"> <a @click="getdata(page)">@{{ page }}</a></li>
                    <li><a @click="nextpage">next</a></li>
                </ul>
        </div>
        </div>

    </script>

    <!-- root element -->
    <div id="orange">
        <form id="search">
            Search <input name="query" v-model="searchQuery">
        </form>
        <orange-grid
                :data="gridData"
                :columns="gridColumns"
                :filter-key="searchQuery"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages">
        </orange-grid>
    </div>

    <div> <a href="/orange/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>
@endsection

@section('scripts')


    <!-- jquery required before -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Vue.filter('formatDate', function(value){

           <!-- instantiate a moment object and hand it the string date -->

            var d = moment(value);
            var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
            var day = d.date()  < 10 ? "0" + (d.date()): d.date();
            return month + "/" + day + "/" + d.year();
        });

        // register the grid component
        Vue.component('orange-grid', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                filterKey: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array
            },
            data: function () {
                var sortOrders = {};
                this.columns.forEach(function (key) {
                    sortOrders[key] = 1;
                });
                return {
                    sortKey: '',
                    sortOrders: sortOrders
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrders[key] = this.sortOrders[key] * -1;
                },
                nextpage: function () {
                    $.getJSON(this.next_page_url, function (data) {
                        this.data = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                    }.bind(this));
                },
                prevpage: function () {
                    $.getJSON(this.prev_page_url, function (data) {
                        this.data = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                    }.bind(this));
                },

                getdata: function (page) {

                    getPage = 'api/orange-vue?page=' + page;

                    $.getJSON(getPage, function (data) {
                        this.data = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                    }.bind(this));
                },
                checkpage: function(page){

                    return page == this.current_page;

                }
            }
        });

        // bootstrap the vue instance
        var orange = new Vue({
            el: '#orange',
            data: {
                searchQuery: '',
                gridColumns: ['Id', 'Name', 'Created'],
                gridData: {
                    rows: null
                },
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: []
            },
            ready: function () {
                this.loadData();
            },

            methods: {
                loadData: function () {
                    $.getJSON('api/orange-vue', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.setPageNumbers();
                    }.bind(this));
                },

                setPageNumbers: function(){

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                }

            }
        });
    </script>
@endsection