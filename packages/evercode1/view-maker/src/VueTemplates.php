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
                    <a href=":::modelRoute:::/@{{row.Id}}">@{{row.Name}}</a>
                </td>
                <td>
                    @{{row.Created}}
                </td>
                <td ><a href=":::modelRoute:::/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

            </section>
        </div>
        </div>

    </script>

    <!-- demo root element -->
    <div id=":::modelName:::">
        <form id="search">
            Search <input name="query" v-model="searchQuery">
        </form>
        <:::gridName:::
                :data="gridData"
                :columns="gridColumns"
                :filter-key="searchQuery">
        <:::endGridName:::>
    </div>
@endsection

@section('scripts')


    <!-- jquery required before -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // register the grid component
        Vue.component(':::gridName:::', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                filterKey: String
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
                }
            }
        });

        // bootstrap the vue instance
        var :::modelName::: = new Vue({
            el: '#:::modelName:::',
            data: {
                searchQuery: '',
                gridColumns: ['Id', 'Name', 'Created'],
                gridData: {
                    rows: null
                }
            },
            ready: function () {
                this.loadData();
            },

            methods: {
                loadData: function () {
                    $.getJSON(':::vueApiRoute:::', function (rows) {
                        this.gridData = rows;
                    }.bind(this));
                }

            }
        });
    </script>
@endsection
EOD;

        return $this->tokens->formatTokens($content);

    }

}
