# 🚤 Boatrace Open API for Programs

[![v3](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v3-blue)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v3)
[![v2](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v2-lightgrey)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v2)
[![license](https://img.shields.io/badge/license-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![pages-build-deployment](https://github.com/boatraceopenapi/programs/actions/workflows/pages/pages-build-deployment/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/pages/pages-build-deployment)
[![test](https://github.com/boatraceopenapi/programs/actions/workflows/test.yml/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/test.yml)
[![psalm](https://github.com/boatraceopenapi/programs/actions/workflows/psalm.yml/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/psalm.yml)
[![audit](https://github.com/boatraceopenapi/programs/actions/workflows/audit.yml/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/audit.yml)
[![sync](https://github.com/boatraceopenapi/programs/actions/workflows/sync.yml/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/sync.yml)
[![keepalive](https://github.com/boatraceopenapi/programs/actions/workflows/keepalive.yml/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/keepalive.yml)
[![dependabot-updates](https://github.com/boatraceopenapi/programs/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/boatraceopenapi/programs/actions/workflows/dependabot/dependabot-updates)

## 🛑 非推奨のお知らせ

> ⚠️ 本リポジトリ（Boatrace Open API for Programs）は**今後の利用が推奨されません**。<br>
> 
> 👉 今後は後継リポジトリの [boatraceopenapi/api](https://github.com/boatraceopenapi/api) をご利用ください。

## ⚠️ 注意事項

> **本 API を利用する前に、以下の内容をご確認ください。**
>
> - ⚡ **本 API は非公式です。**
>   BOATRACE 公式サイトおよび関連団体とは一切関係ありません。
>
> - 🕒 **データはリアルタイムではありません。**
>   GitHub Actions による約 3 時間間隔の定期更新を行っています。リアルタイム配信ではないため、最新の情報が反映されるまで数分程度の遅れが生じる場合があります。
>
> - 📊 **データの正確性・完全性は保証していません。**
>   収集・変換の都合により、欠損や誤りが含まれる可能性があります。
>
> - 🚫 **公式な情報が必要な場合は、必ず BOATRACE 公式サイトをご確認ください。**
>
> - 🙇‍♂️ **本 API の利用は自己責任でお願いします。**

## 📌 概要

この API では、ボートレース（競艇）のデータを取得できます。<br>
データは GitHub Pages 上で公開されており、JSON 形式で提供されます。

- **対応レース場**: 全国 24 場すべてに対応しています。特定のレース場のみを取り出すエンドポイントはなく、1日分のデータに全場の情報が含まれます。
- **取得可能なデータ**: 出走表

## 🌐 エンドポイント

### [![v3](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v3-blue)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v3)

> 📅 対応期間: 2023年05月01日以降

```bash
https://boatraceopenapi.github.io/programs/v3/YYYY/YYYYMMDD.json
```

### [![v2](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v2-lightgrey)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v2)

> 📅 対応期間: 2025年05月01日以降

```bash
https://boatraceopenapi.github.io/programs/v2/YYYY/YYYYMMDD.json
```

📅 YYYY → 年<br>
📅 YYYYMMDD → 年月日<br>
（ 日付は日本標準時 JST〔UTC+9〕基準 ）

> **データが存在しない日付**（対応期間外・未来日付など）を指定した場合、GitHub Pages の仕様により **HTTP 404** が返されます。

## 🧩 サンプル

### [![v3](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v3-blue)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v3)

- 2025年05月01日の出走表
  - [https://boatraceopenapi.github.io/programs/v3/2025/20250501.json](https://boatraceopenapi.github.io/programs/v3/2025/20250501.json)
- 本日の出走表（ JST〔UTC+9〕基準 ）
  - [https://boatraceopenapi.github.io/programs/v3/today.json](https://boatraceopenapi.github.io/programs/v3/today.json)

### [![v2](https://img.shields.io/badge/Boatrace_Open_API_for_Programs-v2-lightgrey)](https://github.com/boatraceopenapi/programs/tree/gh-pages/docs/v2)

- 2025年05月01日の出走表
  - [https://boatraceopenapi.github.io/programs/v2/2025/20250501.json](https://boatraceopenapi.github.io/programs/v2/2025/20250501.json)
- 本日の出走表（ JST〔UTC+9〕基準 ）
  - [https://boatraceopenapi.github.io/programs/v2/today.json](https://boatraceopenapi.github.io/programs/v2/today.json)

## 🔗 関連リポジトリ

| 🏷️ 対象 | 📂 リポジトリ |
|:--|:--|
| 🆕 後継 API | [boatraceopenapi/api](https://github.com/boatraceopenapi/api) |

## 📄 ライセンス

Boatrace Open API for Programs は [MITライセンス](LICENSE) の元で公開されています。
