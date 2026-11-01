# レスポンススキーマ（出走表）

> ⚠️ 本 API は非推奨です。新しく使う場合は後継の [boatraceopenapi/api](https://github.com/boatraceopenapi/api) を利用してください。

## エンドポイント

| バージョン | URL | 対応期間 |
|---|---|---|
| v3 | `https://boatraceopenapi.github.io/programs/v3/YYYY/YYYYMMDD.json` | 2016年08月01日以降 |
| v2 | `https://boatraceopenapi.github.io/programs/v2/YYYY/YYYYMMDD.json` | 2016年10月01日以降 |

- 日付は日本標準時（JST）基準です。データがない日付は HTTP 404 を返します。
- `today.json`（当日）と `yesterday.json`（前日）もあります（例: `/programs/v3/today.json`）。
- 約 3 時間ごとに当日分と前日分を取得し直して上書きします。
- 直前情報は [previews](https://github.com/boatraceopenapi/previews)、結果は [results](https://github.com/boatraceopenapi/results) で配信しています。3 つは同じ日付・同じレースの並びで対応しています。

---

## JSON 全体構造（v3）

```
{
  "programs": [
    {
      "date": "2026-05-01",
      "stadium_number": 1,
      "number": 1,
      ...
      "boats": [
        { "racer_boat_number": 1, ... },
        ...
      ]
    },
    ...
  ]
}
```

- `programs` はその日の全レースの配列です。
- `boats` は出走艇の配列で、`racer_boat_number`（枠番）`1`〜`6` の 6 要素です。
- レースのキーは `(date, stadium_number, number)`、出走艇のキーはそれに `racer_boat_number` を加えたものです。

---

## レース

| フィールド | 型 | 説明 |
|---|---|---|
| `date` | string | 開催日（`YYYY-MM-DD`） |
| `stadium_number` | int | レース場（`1`〜`24`） |
| `number` | int | レース番号（`1`〜`12`） |
| `closed_at` | string | 締切予定時刻（`YYYY-MM-DD HH:MM:SS`、JST） |
| `day_label` | string | 開催日の表記（`初日`・`２日目`〜`６日目`・`最終日`・`中止`・`順延`）。数字は全角です |
| `grade_label` | string | グレードの表記（`SG`・`G1`・`G2`・`G3`・`一般`） |
| `grade_number` | int | グレード（`1`〜`5`） |
| `title` | string | 開催タイトル |
| `subtitle` | string | レース名（`予選`・`優勝戦` など） |
| `distance` | int | 距離（m）。通常 `1800`、短縮時は `1200` |

## 出走艇（`boats[]`）

| フィールド | 型 | 説明 |
|---|---|---|
| `racer_boat_number` | int | 枠番（`1`〜`6`） |
| `racer_name` | string | 選手名 |
| `racer_number` | int | 登録番号。選手はこの番号で識別します |
| `racer_class_number` | int | 級別（`1`: A1、`2`: A2、`3`: B1、`4`: B2） |
| `racer_branch_number` | int | 支部（都道府県コード） |
| `racer_birthplace_number` | int | 出身地（都道府県コード）。「[データの注意点](#データの注意点)」を参照 |
| `racer_age` | int | 年齢 |
| `racer_weight` | float | 体重（kg） |
| `racer_flying_count` | int | フライング数 |
| `racer_late_count` | int | 出遅れ数 |
| `racer_average_start_timing` | float | 平均スタートタイミング |
| `racer_national_top_1_percent` | float | 全国**勝率**（% ではありません） |
| `racer_national_top_2_percent` | float | 全国 2 連率（%） |
| `racer_national_top_3_percent` | float | 全国 3 連率（%） |
| `racer_local_top_1_percent` | float | 当地**勝率**（% ではありません） |
| `racer_local_top_2_percent` | float | 当地 2 連率（%） |
| `racer_local_top_3_percent` | float | 当地 3 連率（%） |
| `racer_assigned_motor_number` | int | モーター番号 |
| `racer_assigned_motor_top_2_percent` | float | モーター 2 連率（%） |
| `racer_assigned_motor_top_3_percent` | float | モーター 3 連率（%） |
| `racer_assigned_boat_number` | int | ボート番号 |
| `racer_assigned_boat_top_2_percent` | float | ボート 2 連率（%） |
| `racer_assigned_boat_top_3_percent` | float | ボート 3 連率（%） |

---

## コード値

`stadium_number`・`grade_number`・`racer_class_number`・`racer_branch_number`・`racer_birthplace_number` の番号は、後継 API と同じ意味です。対応表は後継 API の [コード表](https://boatraceopenapi.github.io/api/v1/codes.md) を参照してください。

| 本 API | 後継 API のコード表での名前 |
|---|---|
| `grade_number` | `grade_number`（本 API では `6`: PG1 は使われていません） |
| `racer_class_number` | `rank_number` |
| `racer_branch_number` / `racer_birthplace_number` | `branch_number` / `birthplace_number` |

---

## データの注意点

- レース場・日の単位で、12 レースすべての値が `null` の日があります（v3 全期間で 99 場日）。出走艇も `racer_boat_number` 以外は `null` です。集計から除外してください。
- `racer_national_top_1_percent`・`racer_local_top_1_percent` は名前に反して勝率（例: `5.37`）です。
- `racer_average_start_timing` は、スタート実績がない選手では `null` です。
- `racer_weight` が `0` のことがあります。体重が取れなかったものとして扱ってください。
- `racer_birthplace_number` は、出身地が京都の選手が全期間で `13`（東京）になっています（`26` は一度も出てきません）。兵庫の選手が `27`（大阪）になっていることもあります。出身地を使う集計では注意してください。
- 当日のファイルは途中の状態です。確定した過去データとして使うのは、翌々日以降に取得したファイルにしてください。

---

## v2 との違い

出走艇（`boats[]`）のフィールドは v3 と同じです。レースのフィールドは次のとおり名前が違い、`day_label`・`grade_label` がありません。

| v3 | v2 |
|---|---|
| `date` | `race_date` |
| `stadium_number` | `race_stadium_number` |
| `number` | `race_number` |
| `closed_at` | `race_closed_at` |
| `day_label` | なし |
| `grade_label` | なし |
| `grade_number` | `race_grade_number` |
| `title` | `race_title` |
| `subtitle` | `race_subtitle` |
| `distance` | `race_distance` |
