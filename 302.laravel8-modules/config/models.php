<?php

return [
    "models" => [
        "option" => [
            "class" => \App\Models\Option::class,
            "insert_item" => [
                "with" => [],
                "where" => [],
                "oreder" => [],
                "on_request" => [],
                "on_response" => [],
            ],
            "insert_list" => [],
            "select_list" => [],
        ],
        "log" => [
            "class" => \App\Models\Log::class,
        ],
        "meta" => [
            "class" => \App\Models\Meta::class,
        ],
        "content" => [
            "class" => \App\Models\Content::class,
            "insert_item" => [
                "exists" => [
                    ["mid", null, "insert_item", "relationship"],
                    ["lid", null, "insert_item", "relationship"],
                    ["metas", "data", "insert_list", "meta"],
                    ["fields", "data", "insert_list", "field"],
                    ["links", "data", "insert_list", "link"],
                ],
            ],
            "insert_list" => [
                "exists" => [
                    ["metas", "insert_meta_list"],
                    ["fields", "insert_field_list"],
                    ["links", "insert_link_list"],
                ],
            ],
            "delete_item" => [],
            "delete_list" => [],
            "select_list" => [
                "with" => [
                    "metas",
                    // "contents",
                    "fields",
                    "relationships",
                ],
                "where" => [
                    ["type", "post"],
                    ["status", "publish"],
                ],
            ],
            "upsert_item" => [
                "exists" => [
                    ["metas"],
                    ["fields"],
                    ["links"],
                ],
            ],
            "faker_item" => [
                "exists" => [],
                "call" => [
                    ["metas", "faker_list", "meta"],
                    ["fields", "faker_list", "field"],
                    ["links", "faker_list", "link"],
                    // [null, "insert_item", "content"],
                ],
                "on_request" => [],
                "on_response" => [
                ],
            ],
            "faker_list" => [
                "exists" => [],
                "call" => [
                    ["metas", "faker_list", "meta"],
                    ["fields", "faker_list", "field"],
                    ["links", "faker_list", "link"],
                    // [null, "insert_content_item"],
                ],
                "on_request" => [],
                "on_response" => [
                ],
            ],
        ],
        "field" => [
            "class" => \App\Models\Field::class,
        ],
        "comment" => [
            "class" => \App\Models\Comment::class,
        ],
        "link" => [
            "class" => \App\Models\Link::class,
        ],
        "relationship" => [
            "class" => \App\Models\Relationship::class,
        ],
    ],
    "methods" => [
        'default' => [
            /**
             * with
             */

            /**
             * where
             */

            /**
             * orderBy
             */
            'orderBy' => [],
            /**
             * have
             */
            "exists" => [
                ["mid"],
                ["mids"],
                ["meta"],
                ["metas"],
                ["lid"],
                ["lids"],
                ["link"],
                ["links"],
                ["relationship"],
                ["relationships"],
            ],
        ],
        "insert_item" => [],
        "insert_list" => [],
        "delete_item" => [],
        "delete_list" => [],
        "updata_item" => [],
        "update_list" => [],
        "increase_item" => [],
        "decrease_item" => [],
        "staging_item" => [],
        "staging_list" => [],
        "release_item" => [],
        "release_list" => [],
        "upsert_item" => [],
        "upsert_list" => [],
        "select_item" => [],
        "select_list" => [],
        "select_page" => [],
        "select_tree" => [],
        "select_random_item" => [],
        "select_random_list" => [],
        "select_random_page" => [],
        "select_count" => [],
        "select_exists" => [],
        "select_max" => [],
        "select_min" => [],
        "select_avg" => [],
        "_insert_item" => [
            "exists" => [
                ["mid", null, "insert_item", "relationship"],
                ["lid", null, "insert_item", "relationship"],
                ["metas", "data", "insert_list", "meta"],
                ["fields", "data", "insert_list", "field"],
                ["links", "data", "insert_list", "link"],
            ],
        ],
        "_insert_list" => [
            "exists" => [
                ["metas", "insert_meta_list"],
                ["fields", "insert_field_list"],
                ["links", "insert_link_list"],
            ],
        ],
        "_upsert_item" => [
            "exists" => [
                ["metas"],
                ["fields"],
                ["links"],
            ],
        ],
        "_faker_item" => [
            "exists" => [],
            "call" => [
                ["metas", "faker_list", "meta"],
                ["contents", "faker_list", "content"],
                ["fields", "faker_list", "field"],
                ["links", "faker_list", "link"],
                [null, "insert_item", "content"],
            ],
            "on_request" => [],
            "on_response" => [
            ],
        ],
        "_faker_list" => [
            "exists" => [],
            "call" => [
                ["metas", "faker_list", "meta"],
                ["fields", "faker_list", "field"],
                ["links", "faker_list", "link"],
                // [null, "insert_content_item"],
            ],
            "on_request" => [],
            "on_response" => [
            ],
        ],
    ],
    "clauses" => [
        "queue" => [
            'with',
            'without',
            'withCount',
            'withPivot',
            'withTimestamps',
            'morphWith',
            'morphWithCount',
            'withDefault',
            'syncWithoutDetaching',
            // 获取包括软删除模型在内的模型
            'withTrashed',
            'onlyTrashed',
            // 对当前查询取消全局作用域
            'withoutGlobalScope',
            // 暂时「禁用」模型触发的所有事件
            'withoutEvents',
            'where',
            'orWhere',
            'whereBetween',
            'orWhereBetween',
            'whereNotBetween',
            'orWhereNotBetween',
            'whereIn',
            'orWhereIn',
            'whereNotIn',
            'orWhereNotIn',
            'whereNull',
            'whereNotNull',
            'orWhereNull',
            'orWhereNotNull',
            'whereDate',
            'whereMonth',
            'whereDay',
            'whereYear',
            'whereTime',
            'whereColumn',
            'orWhereColumn',
            'whereHasMorph',
            'whereDoesntHaveMorph',
            "whereHas",
            "orWhereHas",
            'whereDoesntHave',
            'orWhereDoesntHave',
            "orderBy",
            "groupBy",
        ],
        "with" => [
            'with',
            'without',
            'withCount',
            'withPivot',
            'withTimestamps',
            'morphWith',
            'morphWithCount',
            'withDefault',
            'syncWithoutDetaching',
            // 获取包括软删除模型在内的模型
            'withTrashed',
            'onlyTrashed',
            // 对当前查询取消全局作用域
            'withoutGlobalScope',
            // 暂时「禁用」模型触发的所有事件
            'withoutEvents',
        ],
        "where" => [
            'where',
            'orWhere',
            'whereBetween',
            'orWhereBetween',
            'whereNotBetween',
            'orWhereNotBetween',
            'whereIn',
            'orWhereIn',
            'whereNotIn',
            'orWhereNotIn',
            'whereNull',
            'whereNotNull',
            'orWhereNull',
            'orWhereNotNull',
            'whereDate',
            'whereMonth',
            'whereDay',
            'whereYear',
            'whereTime',
            'whereColumn',
            'orWhereColumn',
            'whereHasMorph',
            'whereDoesntHaveMorph',
            "whereHas",
            "orWhereHas",
            'whereDoesntHave',
            'orWhereDoesntHave'
        ],
        "orderBy" => [
            'orderBy',
        ],
        "groupBy" => [
            'groupBy',
        ],
        "relation" => [
            "hasOne",
            "hasMany",
            "hasOneThrough",
            "hasManyThrough",
            "has",
            "orHas",
            "doesntHave",
            "orDoesntHave",
        ],
        "unclassified" => [],
        "casts" => [
            "with" => "array",
            'without' => "array",
            'withCount' => "array",
            'withPivot' => "array",
            'withTimestamps' => "array",
            'morphWith' => "array",
            'morphWithCount' => "array",
            'withDefault' => "array",
            'syncWithoutDetaching' => "array",
            // 获取包括软删除模型在内的模型
            'withTrashed' => "array",
            'onlyTrashed' => "array",
            // 对当前查询取消全局作用域
            'withoutGlobalScope' => "array",
            // 暂时「禁用」模型触发的所有事件
            'withoutEvents' => "array",

            "where" => "array",
            'orWhere' => "array",
            'whereBetween' => "array",
            'orWhereBetween' => "array",
            'whereNotBetween' => "array",
            'orWhereNotBetween' => "array",
            'whereIn' => "array",
            'orWhereIn' => "array",
            'whereNotIn' => "array",
            'orWhereNotIn' => "array",
            'whereNull' => "array",
            'whereNotNull' => "array",
            'orWhereNull' => "array",
            'orWhereNotNull' => "array",
            'whereDate' => "array",
            'whereMonth' => "array",
            'whereDay' => "array",
            'whereYear' => "array",
            'whereTime' => "array",
            'whereColumn' => "array",
            'orWhereColumn' => "array",
            'whereHasMorph' => "array",
            'whereDoesntHaveMorph' => "array",
            "whereHas" => "array",
            "orWhereHas" => "array",
            'whereDoesntHave' => "array",
            'orWhereDoesntHave' => "array",
        ],
    ],
];