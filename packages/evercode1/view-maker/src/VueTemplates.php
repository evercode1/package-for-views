<?php

namespace Evercode1\ViewMaker;


class VueTemplates
{

    public $tokens;

    public function __construct(array $tokens)
    {

        $this->tokens = new FormatsTokens($tokens);

    }


    public function vueIndexTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')
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
        <li><a href=':::modelRoute:::'>:::upperCaseModelName:::</a></li>
        </ol>

        <h1>:::modelsUpperCase:::</h1>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
            <form id="search">
                    Search <input name="query" v-model="query" @keyup="search(query)">
                </form>
            <div class="pull-right">
                    @{{ total }} Total Results
            </div>
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
                      :class="sortOrder > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href=":::modelRoute:::/@{{row.Id}}">@{{row.Name}}</a>
                </td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href=":::modelRoute:::/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

                    <div class="pull-right">

                    page @{{ current_page }} of   @{{ last_page }} pages
                    </div>

            </section>
            <div class="row">
            <div class="pull-right" style="margin-top:20px; margin-left:20px;">

                <button @click="getData(go_to_page)"class="btn btn-default">
                Go To Page:</button>
                <input v-model="go_to_page"></input>

            </div>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click="getData(first_page_url)"> << </a></li>
                    <li v-if="checkUrlNotNull(prev_page_url)"><a @click.prevent="getData(prev_page_url)" >prev</a></li>
                    <li v-for="page in pages" v-if="page > current_page - 2 && page < current_page + 2" v-bind:class="{'active': checkPage(page)}"> <a @click="getData(page)">@{{ page }}</a></li>
                    <li v-if="checkUrlNotNull(next_page_url)"><a @click="getData(next_page_url)">next</a></li>
                    <li><a @click="getData(last_page_url)"> >> </a></li>
                </ul>
    </div>
        </div>
        </div>

    </script>

    <!-- root element -->
    <div id=":::modelName:::">
        <:::gridName:::
                :data="gridData"
                :columns="gridColumns"
                :query="query"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages"
                :last_page_url="last_page_url"
                :first_page_url="first_page_url"
                :go_to_page="go_to_page">
        <:::endGridName:::>
    </div>

    <div> <a href=":::modelRoute:::/create">
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
        Vue.component(':::gridName:::', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                query: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array,
                first_page_url: String,
                last_page_url: String,
                go_to_page: Number
            },
            data: function () {
                var sortOrder = 1;
                var sortKey = '';

                return {
                    sortKey: sortKey,
                    sortOrder: sortOrder
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                    this.getData(1);

                },

                search: function(query){

                this.getData(query);

                },

                getData: function (page) {

                    switch (page){

                        case this.prev_page_url :

                                    getPage = this.prev_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                    break;

                        case this.next_page_url :

                                getPage = this.next_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                break;


                        case this.first_page_url :

                            getPage = this.first_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.last_page_url :

                            getPage = this.last_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                            case this.query :

                            getPage = ':::vueApiRoute:::?keyword=' + this.query + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.go_to_page :

                            if( this.go_to_page != '' && this.go_to_page <= parseInt(this.last_page)){

                                getPage = ':::vueApiRoute:::?page=' + this.go_to_page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                                this.go_to_page = '';

                            } else {

                                alert('Please enter a valid page number');
                            }

                            break;

                        default :

                            getPage = ':::vueApiRoute:::?page=' + page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                            break;
                    }

                    if (this.query == '' && getPage != null){

                        $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = data.next_page_url;
                            this.prev_page_url = data.prev_page_url;
                            this.current_page = data.current_page;
                            }.bind(this));

                    } else {

                        if (getPage != null){

                            $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = (data.next_page_url == null) ? null : data.next_page_url + '&keyword=' +this.query;
                            this.prev_page_url = (data.prev_page_url == null) ? null : data.prev_page_url + '&keyword=' +this.query;
                            this.first_page_url = ':::vueApiRoute:::?page=1&keyword=' +this.query;
                            this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page + '&keyword=' +this.query;
                            this.current_page = data.current_page;
                            this.resetPageNumbers();
                            }.bind(this));

                    }

                }

                },
                checkPage: function(page){

                    return page == this.current_page;

                },

                resetPageNumbers: function(){

                    this.pages = [];

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                },

                checkUrlNotNull: function(url){

                    return url != null;

                }
            }
        });

        // bootstrap the vue instance
        var :::modelName::: = new Vue({
            el: '#:::modelName:::',
            data: {
                query: '',
                gridColumns: ['Id', 'Name', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null
            },
            ready: function () {
                this.loadData();
            },

            components: ':::gridName:::',

            methods: {
                loadData: function () {
                    $.getJSON(':::vueApiRoute:::', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.first_page_url = ':::vueApiRoute:::?page=1';
                        this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page;
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
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function vueIndexSlugTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')
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
        <li><a href=':::modelRoute:::'>:::upperCaseModelName:::</a></li>
        </ol>

        <h1>:::modelsUpperCase:::</h1>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
            <form id="search">
                    Search <input name="query" v-model="query" @keyup="search(query)">
                </form>
            <div class="pull-right">
                    @{{ total }} Total Results
            </div>
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
                      :class="sortOrder > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href=":::modelRoute:::/@{{row.Id}}-@{{row.Slug}}">@{{row.Name}}</a>
                </td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href=":::modelRoute:::/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

                    <div class="pull-right">

                    page @{{ current_page }} of   @{{ last_page }} pages
                    </div>

            </section>
            <div class="row">
            <div class="pull-right" style="margin-top:20px; margin-left:20px;">

                <button @click="getData(go_to_page)"class="btn btn-default">
                Go To Page:</button>
                <input v-model="go_to_page"></input>

            </div>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click="getData(first_page_url)"> << </a></li>
                    <li v-if="checkUrlNotNull(prev_page_url)"><a @click.prevent="getData(prev_page_url)" >prev</a></li>
                    <li v-for="page in pages" v-if="page > current_page - 2 && page < current_page + 2" v-bind:class="{'active': checkPage(page)}"> <a @click="getData(page)">@{{ page }}</a></li>
                    <li v-if="checkUrlNotNull(next_page_url)"><a @click="getData(next_page_url)">next</a></li>
                    <li><a @click="getData(last_page_url)"> >> </a></li>
                </ul>
    </div>
        </div>
        </div>

    </script>

    <!-- root element -->
    <div id=":::modelName:::">
        <:::gridName:::
                :data="gridData"
                :columns="gridColumns"
                :query="query"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages"
                :last_page_url="last_page_url"
                :first_page_url="first_page_url"
                :go_to_page="go_to_page">
        <:::endGridName:::>
    </div>

    <div> <a href=":::modelRoute:::/create">
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
        Vue.component(':::gridName:::', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                query: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array,
                first_page_url: String,
                last_page_url: String,
                go_to_page: Number
            },
            data: function () {
                var sortOrder = 1;
                var sortKey = '';

                return {
                    sortKey: sortKey,
                    sortOrder: sortOrder
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                    this.getData(1);

                },

                search: function(query){

                this.getData(query);

                },

                getData: function (page) {

                    switch (page){

                        case this.prev_page_url :

                                    getPage = this.prev_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                    break;

                        case this.next_page_url :

                                getPage = this.next_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                break;


                        case this.first_page_url :

                            getPage = this.first_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.last_page_url :

                            getPage = this.last_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                            case this.query :

                            getPage = ':::vueApiRoute:::?keyword=' + this.query + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.go_to_page :

                            if( this.go_to_page != '' && this.go_to_page <= parseInt(this.last_page)){

                                getPage = ':::vueApiRoute:::?page=' + this.go_to_page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                                this.go_to_page = '';

                            } else {

                                alert('Please enter a valid page number');
                            }

                            break;

                        default :

                            getPage = ':::vueApiRoute:::?page=' + page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                            break;
                    }

                    if (this.query == '' && getPage != null){

                        $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = data.next_page_url;
                            this.prev_page_url = data.prev_page_url;
                            this.current_page = data.current_page;
                            }.bind(this));

                    } else {

                        if (getPage != null){

                            $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = (data.next_page_url == null) ? null : data.next_page_url + '&keyword=' +this.query;
                            this.prev_page_url = (data.prev_page_url == null) ? null : data.prev_page_url + '&keyword=' +this.query;
                            this.first_page_url = ':::vueApiRoute:::?page=1&keyword=' +this.query;
                            this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page + '&keyword=' +this.query;
                            this.current_page = data.current_page;
                            this.resetPageNumbers();
                            }.bind(this));

                    }

                }

                },
                checkPage: function(page){

                    return page == this.current_page;

                },

                resetPageNumbers: function(){

                    this.pages = [];

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                },

                checkUrlNotNull: function(url){

                    return url != null;

                }
            }
        });

        // bootstrap the vue instance
        var :::modelName::: = new Vue({
            el: '#:::modelName:::',
            data: {
                query: '',
                gridColumns: ['Id', 'Name', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null
            },
            ready: function () {
                this.loadData();
            },

            components: ':::gridName:::',

            methods: {
                loadData: function () {
                    $.getJSON(':::vueApiRoute:::', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.first_page_url = ':::vueApiRoute:::?page=1';
                        this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page;
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
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function vueChildIndexTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')
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
        <li><a href=':::modelRoute:::'>:::upperCaseModelName:::</a></li>
        </ol>

        <h1>:::modelsUpperCase:::</h1>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
            <form id="search">
                    Search <input name="query" v-model="query" @keyup="search(query)">
                </form>
            <div class="pull-right">
                    @{{ total }} Total Results
            </div>
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
                      :class="sortOrder > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href=":::modelRoute:::/@{{row.Id}}">@{{row.Name}}</a>
                </td>
                <td>@{{ row.:::parent::: }}</td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href=":::modelRoute:::/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

                    <div class="pull-right">

                    page @{{ current_page }} of   @{{ last_page }} pages
                    </div>

            </section>
            <div class="row">
            <div class="pull-right" style="margin-top:20px; margin-left:20px;">

                <button @click="getData(go_to_page)"class="btn btn-default">
                Go To Page:</button>
                <input v-model="go_to_page"></input>

            </div>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click="getData(first_page_url)"> << </a></li>
                    <li v-if="checkUrlNotNull(prev_page_url)"><a @click.prevent="getData(prev_page_url)" >prev</a></li>
                    <li v-for="page in pages" v-if="page > current_page - 2 && page < current_page + 2" v-bind:class="{'active': checkPage(page)}"> <a @click="getData(page)">@{{ page }}</a></li>
                    <li v-if="checkUrlNotNull(next_page_url)"><a @click="getData(next_page_url)">next</a></li>
                    <li><a @click="getData(last_page_url)"> >> </a></li>
                </ul>
    </div>
        </div>
        </div>

    </script>

    <!-- root element -->
    <div id=":::modelName:::">
        <:::gridName:::
                :data="gridData"
                :columns="gridColumns"
                :query="query"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages"
                :last_page_url="last_page_url"
                :first_page_url="first_page_url"
                :go_to_page="go_to_page">
        <:::endGridName:::>
    </div>

    <div> <a href=":::modelRoute:::/create">
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
        Vue.component(':::gridName:::', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                query: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array,
                first_page_url: String,
                last_page_url: String,
                go_to_page: Number
            },
            data: function () {
                var sortOrder = 1;
                var sortKey = '';

                return {
                    sortKey: sortKey,
                    sortOrder: sortOrder
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                    this.getData(1);

                },

                search: function(query){

                this.getData(query);

                },

                getData: function (page) {

                    switch (page){

                        case this.prev_page_url :

                                    getPage = this.prev_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                    break;

                        case this.next_page_url :

                                getPage = this.next_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                break;


                        case this.first_page_url :

                            getPage = this.first_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.last_page_url :

                            getPage = this.last_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                            case this.query :

                            getPage = ':::vueApiRoute:::?keyword=' + this.query + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.go_to_page :

                            if( this.go_to_page != '' && this.go_to_page <= parseInt(this.last_page)){

                                getPage = ':::vueApiRoute:::?page=' + this.go_to_page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                                this.go_to_page = '';

                            } else {

                                alert('Please enter a valid page number');
                            }

                            break;

                        default :

                            getPage = ':::vueApiRoute:::?page=' + page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                            break;
                    }

                    if (this.query == '' && getPage != null){

                        $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = data.next_page_url;
                            this.prev_page_url = data.prev_page_url;
                            this.current_page = data.current_page;
                            }.bind(this));

                    } else {

                        if (getPage != null){

                            $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = (data.next_page_url == null) ? null : data.next_page_url + '&keyword=' +this.query;
                            this.prev_page_url = (data.prev_page_url == null) ? null : data.prev_page_url + '&keyword=' +this.query;
                            this.first_page_url = ':::vueApiRoute:::?page=1&keyword=' +this.query;
                            this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page + '&keyword=' +this.query;
                            this.current_page = data.current_page;
                            this.resetPageNumbers();
                            }.bind(this));

                    }

                }

                },
                checkPage: function(page){

                    return page == this.current_page;

                },

                resetPageNumbers: function(){

                    this.pages = [];

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                },

                checkUrlNotNull: function(url){

                    return url != null;

                }
            }
        });

        // bootstrap the vue instance
        var :::modelName::: = new Vue({
            el: '#:::modelName:::',
            data: {
                query: '',
                gridColumns: ['Id', 'Name', ':::parent:::', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null
            },
            ready: function () {
                this.loadData();
            },

            components: ':::gridName:::',

            methods: {
                loadData: function () {
                    $.getJSON(':::vueApiRoute:::', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.first_page_url = ':::vueApiRoute:::?page=1';
                        this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page;
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
EOD;

        return $this->tokens->formatTokens($content);

    }

    public function vueChildIndexSlugTemplate()
    {

        $content = <<<EOD
@extends('layouts.:::masterPage:::')
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
        <li><a href=':::modelRoute:::'>:::upperCaseModelName:::</a></li>
        </ol>

        <h1>:::modelsUpperCase:::</h1>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
            <form id="search">
                    Search <input name="query" v-model="query" @keyup="search(query)">
                </form>
            <div class="pull-right">
                    @{{ total }} Total Results
            </div>
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
                      :class="sortOrder > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href=":::modelRoute:::/@{{row.Id}}-@{{row.Slug}}">@{{row.Name}}</a>
                </td>
                <td>@{{ row.:::parent::: }}</td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href=":::modelRoute:::/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

                    <div class="pull-right">

                    page @{{ current_page }} of   @{{ last_page }} pages
                    </div>

            </section>
            <div class="row">
            <div class="pull-right" style="margin-top:20px; margin-left:20px;">

                <button @click="getData(go_to_page)"class="btn btn-default">
                Go To Page:</button>
                <input v-model="go_to_page"></input>

            </div>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click="getData(first_page_url)"> << </a></li>
                    <li v-if="checkUrlNotNull(prev_page_url)"><a @click.prevent="getData(prev_page_url)" >prev</a></li>
                    <li v-for="page in pages" v-if="page > current_page - 2 && page < current_page + 2" v-bind:class="{'active': checkPage(page)}"> <a @click="getData(page)">@{{ page }}</a></li>
                    <li v-if="checkUrlNotNull(next_page_url)"><a @click="getData(next_page_url)">next</a></li>
                    <li><a @click="getData(last_page_url)"> >> </a></li>
                </ul>
    </div>
        </div>
        </div>

    </script>

    <!-- root element -->
    <div id=":::modelName:::">
        <:::gridName:::
                :data="gridData"
                :columns="gridColumns"
                :query="query"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages"
                :last_page_url="last_page_url"
                :first_page_url="first_page_url"
                :go_to_page="go_to_page">
        <:::endGridName:::>
    </div>

    <div> <a href=":::modelRoute:::/create">
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
        Vue.component(':::gridName:::', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                query: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array,
                first_page_url: String,
                last_page_url: String,
                go_to_page: Number
            },
            data: function () {
                var sortOrder = 1;
                var sortKey = '';

                return {
                    sortKey: sortKey,
                    sortOrder: sortOrder
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                    this.getData(1);

                },

                search: function(query){

                this.getData(query);

                },

                getData: function (page) {

                    switch (page){

                        case this.prev_page_url :

                                    getPage = this.prev_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                    break;

                        case this.next_page_url :

                                getPage = this.next_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                break;


                        case this.first_page_url :

                            getPage = this.first_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.last_page_url :

                            getPage = this.last_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                            case this.query :

                            getPage = ':::vueApiRoute:::?keyword=' + this.query + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.go_to_page :

                            if( this.go_to_page != '' && this.go_to_page <= parseInt(this.last_page)){

                                getPage = ':::vueApiRoute:::?page=' + this.go_to_page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                                this.go_to_page = '';

                            } else {

                                alert('Please enter a valid page number');
                            }

                            break;

                        default :

                            getPage = ':::vueApiRoute:::?page=' + page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                            break;
                    }

                    if (this.query == '' && getPage != null){

                        $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = data.next_page_url;
                            this.prev_page_url = data.prev_page_url;
                            this.current_page = data.current_page;
                            }.bind(this));

                    } else {

                        if (getPage != null){

                            $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = (data.next_page_url == null) ? null : data.next_page_url + '&keyword=' +this.query;
                            this.prev_page_url = (data.prev_page_url == null) ? null : data.prev_page_url + '&keyword=' +this.query;
                            this.first_page_url = ':::vueApiRoute:::?page=1&keyword=' +this.query;
                            this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page + '&keyword=' +this.query;
                            this.current_page = data.current_page;
                            this.resetPageNumbers();
                            }.bind(this));

                    }

                }

                },
                checkPage: function(page){

                    return page == this.current_page;

                },

                resetPageNumbers: function(){

                    this.pages = [];

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                },

                checkUrlNotNull: function(url){

                    return url != null;

                }
            }
        });

        // bootstrap the vue instance
        var :::modelName::: = new Vue({
            el: '#:::modelName:::',
            data: {
                query: '',
                gridColumns: ['Id', 'Name', ':::parent:::', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null
            },
            ready: function () {
                this.loadData();
            },

            components: ':::gridName:::',

            methods: {
                loadData: function () {
                    $.getJSON(':::vueApiRoute:::', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.first_page_url = ':::vueApiRoute:::?page=1';
                        this.last_page_url = ':::vueApiRoute:::?page=' + this.last_page;
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
EOD;

        return $this->tokens->formatTokens($content);

    }


}
