<?php
/**
 * This code is licensed under the MIT License.pyright (c) 2015-2017 Alexey Kopytko
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace GMO\API;

/**
 * Common error codes.
 *
 * For a list of most known codes see:
 * https://faq.gmo-pg.com/service/Detail.aspx?id=480
 */
class Errors
{
    /**
     * 2. 弊社システムから返却するエラーコード (EまたはMが含まれるエラー)
     * 2.1. 既にオーダーIDが存在している時に発生するエラーです。
     * 同じオーダーIDで、既に処理されている取引がないかどうかご確認下さい。
     * 新たに取引をする場合は、別のオーダーIDを発番していただく必要があります。
     * ※オーダーIDに“-1”などの枝番をつけていただいても、別のオーダーIDとしてご利用いただけます。
     */
    const DUPLICATE_ORDER_ID = 'E01040010';

    /**
     * @see https://faq.gmo-pg.com/service/Detail.aspx?id=2039
     */
    const NO_FULL_CARD_NUMBERS_ALLOWED = 'E61040001';

    /**
     * Some error codes and descriptions in English
     */
    const ERROR_CODE_TO_DESCRIPTION_MAP_ENGLISH = [
        'E01040001' => 'Order ID must be specified in the request.',
        'E01040003' => 'Order ID has more characters than allowed.',
        'E01040010' => 'This order ID was used previously.',
        'E01040013' => 'Order ID contains ivalid characters. Only letter, digits, and a dash are allowed.',
    ];

    /**
     * Error codes and descriptions in Japanese from Literally WordPress
     */
    const ERROR_CODE_TO_DESCRIPTION_MAP_JAPANESE = [
        'E00000000' => '特になし',
        'E01010001' => 'ショップIDが指定されていません。',
        'E01020001' => 'ショップパスワードが指定されていません。',
        'E01030002' => '指定されたIDとパスワードのショップが存在しません。',
        'E01040001' => 'オーダーIDが指定されていません。',
        'E01040003' => 'オーダーIDが最大文字数を超えています。',
        'E01040010' => '既にオーダーIDが存在しています。',
        'E01040013' => 'オーダーIDに不正な文字が存在します。',
        'E01050001' => '処理区分が指定されていません。',
        'E01050002' => '指定された処理区分は定義されていません。',
        'E01050004' => '指定した処理区分の処理は実行出来ません。',
        'E01060001' => '利用金額が指定されていません。',
        'E01060005' => '利用金額が最大桁数を超えています。',
        'E01060006' => '利用金額に数字以外の文字が含まれています。',
        'E01070005' => '税送料が最大桁数を超えています。',
        'E01070006' => '税送料に数字以外の文字が含まれています。',
        'E01080007' => '3Dセキュア使用フラグに0,1以外の値が指定されています。',
        'E01090001' => '取引IDが指定されていません。',
        'E01100001' => '取引パスワードが指定されていません。',
        'E01110002' => '指定されたIDとパスワードの取引が存在しません。',
        'E01120008' => 'カード種別の書式が誤っています。',
        'E01130002' => '指定されたカード略称が存在しません。',
        'E01140007' => '対応支払方法に0,1以外の値が指定されています。',
        'E01140003' => '対応支払方法が最大文字数を超えています。',
        'E01150007' => '対応分割回数に0,1以外の値が指定されています。',
        'E01160007' => '対応ボーナス分割回数に0,1以外の値が指定されています。',
        'E01170001' => 'カード番号が指定されていません。',
        'E01170003' => 'カード番号が最大文字数を超えています。',
        'E01170006' => 'カード番号に数字以外の文字が含まれています。',
        'E01170011' => 'カード番号が10桁～16桁の範囲ではありません。',
        'E01180001' => '有効期限が指定されていません。',
        'E01180003' => '有効期限が4桁ではありません。',
        'E01180006' => '有効期限に数字以外の文字が含まれています。',
        'E01190001' => 'サイトIDが指定されていません。',
        'E01200001' => 'サイトパスワードが指定されていません。',
        'E01210002' => '指定されたIDとパスワードのサイトが存在しません。',
        'E01220001' => '会員IDが指定されていません。',
        'E01230001' => 'カード登録連番が指定されていません。',
        'E01230006' => 'カード登録連番に数字以外の文字が含まれています。',
        'E01230009' => 'カード登録連番が最大登録可能数を超えています。',
        'E01240002' => '指定されたサイトIDと会員ID、カード連番のカードが存在しません。',
        'E01250010' => 'カードパスワードが一致しません。',
        'E01260001' => '支払方法が指定されていません。',
        'E01250002' => '指定された支払方法が存在しません。',
        'E01260010' => '指定された支払方法はご利用できません。',
        'E01270001' => '支払回数が指定されていません。',
        'E01270005' => '支払回数が1～2桁ではありません。',
        'E01270006' => '支払回数の数字以外の文字が含まれています。',
        'E01270010' => '指定された支払回数はご利用できません。',
        'E01280012' => '加盟店URLの値が最大バイト数を超えています。',
        'E01290001' => 'HTTP_ACCEPTが指定されていません。',
        'E01300001' => 'HTTP_USER_AGENTが指定されていません。',
        'E01310001' => '使用端末が指定されていません。',
        'E01310007' => '使用端末に0,1以外の値が指定されています。',
        'E01320012' => '加盟店自由項目1の値が最大バイト数を超えています。',
        'E01330012' => '加盟店自由項目2の値が最大バイト数を超えています。',
        'E01340012' => '加盟店自由項目3の値が最大バイト数を超えています。',
        'E01350001' => 'MDが指定されていません。',
        'E01360001' => 'PaREsが指定されていません。',
        'E01370012' => '3Dセキュア表示店舗名の値が最大バイト数を超えています。',
        'E01380007' => '決済方法フラグに0,1以外の値が指定されています。',
        'E01390002' => '指定されたサイトIDと会員IDの組み合わせが存在しません。',
        'E01390010' => '指定されたサイトIDと会員IDの組み合わせは既に存在しています。',
        'E11010001' => 'この取引は既に決済が終了しています。',
        'E11010002' => 'この取引は決済が終了していませんので、変更する事が出来ません。',
        'E11010003' => 'この取引は指定処理区分処理を行う事が出来ません。',
        'E21010001' => '3Dセキュア認証に失敗しました。もう一度、購入画面からやり直して下さい。',
        'E21020001' => '3Dセキュア認証に失敗しました。もう一度、購入画面からやり直して下さい。',
        'E21020002' => '3Dセキュア認証がキャンセルされました。もう一度、購入画面からやり直して下さい。',
        'E41170002' => '入力されたカードの会社には対応していません。別のカード番号を入力して下さい。',
        'E41170099' => 'カード番号に誤りがあります。再度確認して入力して下さい。',
        'E90010001' => '現在処理を行っているのでもうしばらくお待ち下さい。',
        'E61010001' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        'E61010002' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        'E61010003' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        'E91019999' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        'E91029999' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        'E91099999' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C010000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C030000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C120000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C130000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C140000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C150000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C500000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C510000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C530000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C540000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C550000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C560000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C570000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C580000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C600000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C700000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C710000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C720000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C730000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C740000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C750000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C760000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C770000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42C780000' => '決済処理に失敗しました。申し訳ございませんが、しばらくした後にもう一度購入画面からやり直してください。',
        '42G020000' => 'カード残高が不足しているために、決済が完了できませんでした。',
        '42G040000' => 'カード残高が不足しているために、決済が完了できませんでした。',
        '42G030000' => 'カード限度額を超えているために、決済が完了できませんでした。',
        '42G050000' => 'カード限度額を超えているために、決済が完了できませんでした。',
        '42G420000' => '暗証番号が誤っていた為に、決済を完了する事が出来ませんでした。',
        '42G540000' => 'このカードでは取引をする事が出来ません。',
        '42G550000' => 'カード限度額を超えているために、決済が完了できませんでした。',
        '42G650000' => 'カード番号に誤りがあるために、決済を完了できませんでした。',
        '42G670000' => '商品コードに誤りがあるために、決済を完了できませんでした。',
        '42G680000' => '金額に誤りがあるために、決済を完了できませんでした。',
        '42G690000' => '税送料に誤りがあるために、決済を完了できませんでした。',
        '42G700000' => 'ボーナス回数に誤りがあるために、決済を完了できませんでした。',
        '42G710000' => 'ボーナス月に誤りがあるために、決済を完了できませんでした。',
        '42G720000' => 'ボーナス額に誤りがあるために、決済を完了できませんでした。',
        '42G730000' => '支払開始月に誤りがあるために、決済を完了できませんでした。',
        '42G740000' => '分割回数に誤りがあるために、決済を完了できませんでした。',
        '42G750000' => '分割金額に誤りがあるために、決済を完了できませんでした。',
        '42G760000' => '初回金額に誤りがあるために、決済を完了できませんでした。',
        '42G770000' => '業務区分に誤りがあるために、決済を完了できませんでした。',
        '42G780000' => '支払区分に誤りがあるために、決済を完了できませんでした。',
        '42G790000' => '照会区分に誤りがあるために、決済を完了できませんでした。',
        '42G800000' => '取消区分に誤りがあるために、決済を完了できませんでした。',
        '42G810000' => '取消取扱区分に誤りがあるために、決済を完了できませんでした。',
        '42G830000' => '有効期限に誤りがあるために、決済を完了できませんでした。',
        '42G950000' => 'このカードでは取引をする事が出来ません。',
        '42G120000' => 'このカードでは取引をする事が出来ません。',
        '42G220000' => 'このカードでは取引をする事が出来ません。',
        '42G300000' => 'このカードでは取引をする事が出来ません。',
        '42G560000' => 'このカードでは取引をする事が出来ません。',
        '42G600000' => 'このカードでは取引をする事が出来ません。',
        '42G610000' => 'このカードでは取引をする事が出来ません。',
        '42G960000' => 'このカードでは取引をする事が出来ません。',
        '42G970000' => 'このカードでは取引をする事が出来ません。',
        '42G980000' => 'このカードでは取引をする事が出来ません。',
        '42G990000' => 'このカードでは取引をする事が出来ません。',
        'M01001005' => 'バージョンの文字数が最大文字数を超えています。',
        'M01002001' => 'ショップIDが指定されていません。',
        'M01002002' => '指定されたIDとパスワードのショップが存在しません。',
        'M01002008' => 'ショップIDの書式が正しくありません。',
        'M01003001' => 'ショップパスワードが指定されていません。',
        'M01003008' => 'ショップパスワードの書式が正しくありません。',
        'M01004001' => 'オーダーIDが指定されていません。',
        'M01004002' => '指定されたオーダーIDの取引は登録されていません。',
        'M01004010' => '既にオーダーIDが存在しています。',
        'M01004012' => 'オーダーIDが最大文字数を超えています。',
        'M01004013' => 'オーダーIDに不正な文字が含まれています。',
        'M01004014' => '指定されたオーダーIDの取引は既に決済を依頼してます。',
        'M01005001' => '利用金額が指定されていません。',
        'M01005005' => '利用金額が最大桁数を超えています。',
        'M01005006' => '利用金額に数字以外の文字が含まれています。',
        'M01005011' => '利用金額が有効な範囲を超えています。',
        'M01006005' => '税送料が最大桁数を超えています。',
        'M01006006' => '税送料に数字以外の文字が含まれています。',
        'M01007001' => '取引IDが指定されていません。',
        'M01007008' => '取引IDの書式が正しくありません。',
        'M01008001' => '取引Iパスワードが指定されていません。',
        'M01008008' => '取引パスワードの書式が正しくありません。',
        'M01009001' => '支払先コンビニコードが指定されていません。',
        'M01009002' => '指定された支払先コンビニコードが正しくありません。',
        'M01009005' => '支払先コンビニコードが最大文字数を超えています。',
        'M01010001' => '氏名が指定されていません。',
        'M01010012' => '氏名が最大バイト数を超えています。',
        'M01010013' => '氏名に不正な文字が含まれています。',
        'M01011001' => 'フリガナが指定されていません。',
        'M01011012' => 'フリガナが最大バイト数を超えています。',
        'M01011013' => 'フリガナに不正な文字が含まれています。',
        'M01012001' => '電話番号が指定されていません。',
        'M01012005' => '電話番号が最大文字数を超えています。',
        'M01012008' => '電話番号の書式が正しくありません。',
        'M01013005' => '支払期限日数が最大文字数を超えています。',
        'M01013006' => '支払期限日数に数字以外の文字が指定されています。',
        'M01013011' => '支払期限日数が有効な範囲ではありません。',
        'M01014001' => '結果通知先メールアドレスが指定されていません。',
        'M01014005' => '結果通知先メールアドレスが最大文字数を超えています。',
        'M01014008' => '結果通知先メールアドレスの書式が正しくありません。',
        'M01015005' => '加盟店メールアドレスが最大文字数を超えています。',
        'M01015008' => '加盟店メールアドレスの書式が正しくありません。',
        'M01016012' => '予約番号が最大バイト数を超えています。',
        'M01016013' => '予約番号に不正な文字が含まれています。',
        'M01017012' => '会員番号が最大バイト数を超えています。',
        'M01017013' => '会員番号に不正な文字が含まれています。',
        'M01018012' => 'POSレジ表示欄1が最大バイト数を超えています。',
        'M01018013' => 'POSレジ表示欄1に不正な文字が含まれています。',
        'M01019012' => 'POSレジ表示欄2が最大バイト数を超えています。',
        'M01019013' => 'POSレジ表示欄2に不正な文字が含まれています。',
        'M01020012' => 'POSレジ表示欄3が最大バイト数を超えています。',
        'M01020013' => 'POSレジ表示欄3に不正な文字が含まれています。',
        'M01021012' => 'POSレジ表示欄4が最大バイト数を超えています。',
        'M01021013' => 'POSレジ表示欄4に不正な文字が含まれています。',
        'M01022012' => 'POSレジ表示欄5が最大バイト数を超えています。',
        'M01022013' => 'POSレジ表示欄5に不正な文字が含まれています。',
        'M01023012' => 'POSレジ表示欄6が最大バイト数を超えています。',
        'M01023013' => 'POSレジ表示欄6に不正な文字が含まれています。',
        'M01024012' => 'POSレジ表示欄7が最大バイト数を超えています。',
        'M01024013' => 'POSレジ表示欄7に不正な文字が含まれています。',
        'M01025012' => 'POSレジ表示欄8が最大バイト数を超えています。',
        'M01025013' => 'POSレジ表示欄8に不正な文字が含まれています。',
        'M01026012' => 'レシート表示欄1が最大バイト数を超えています。',
        'M01026013' => 'レシート表示欄1に不正な文字が含まれています。',
        'M01027012' => 'レシート表示欄2が最大バイト数を超えています。',
        'M01027013' => 'レシート表示欄2に不正な文字が含まれています。',
        'M01028012' => 'レシート表示欄3が最大バイト数を超えています。',
        'M01028013' => 'レシート表示欄3に不正な文字が含まれています。',
        'M01029012' => 'レシート表示欄4が最大バイト数を超えています。',
        'M01029013' => 'レシート表示欄4に不正な文字が含まれています。',
        'M01030012' => 'レシート表示欄5が最大バイト数を超えています。',
        'M01030013' => 'レシート表示欄5に不正な文字が含まれています。',
        'M01031012' => 'レシート表示欄6が最大バイト数を超えています。',
        'M01031013' => 'レシート表示欄6に不正な文字が含まれています。',
        'M01032012' => 'レシート表示欄7が最大バイト数を超えています。',
        'M01032013' => 'レシート表示欄7に不正な文字が含まれています。',
        'M01033012' => 'レシート表示欄8が最大バイト数を超えています。',
        'M01033013' => 'レシート表示欄8に不正な文字が含まれています。',
        'M01034012' => 'レシート表示欄9が最大バイト数を超えています。',
        'M01034013' => 'レシート表示欄9に不正な文字が含まれています。',
        'M01035012' => 'レシート表示欄10が最大バイト数を超えています。',
        'M01035013' => 'レシート表示欄10に不正な文字が含まれています。',
        'M01036001' => 'お問合せ先が指定されていません。',
        'M01036012' => 'お問合せ先が最大バイト数を超えています。',
        'M01036013' => 'お問合せ先に不正な文字が含まれています。',
        'M01037001' => 'お問合せ先電話番号が指定されていません。',
        'M01037005' => 'お問合せ先電話番号が最大文字数を超えています。',
        'M01037008' => 'お問合せ先電話番号に数字、−以外の文字が指定されています。',
        'M01038001' => 'お問合せ先受付時間が指定されていません。',
        'M01038005' => 'お問合せ先受付時間が最大文字数を超えています。',
        'M01038008' => 'お問合せ先受付時間に数字、”:”、”-“以外の文字が指定されています。',
        'M01039012' => '加盟店自由項目1が最大バイト数を超えています。',
        'M01039013' => '加盟店自由項目1に不正な文字が含まれています。',
        'M01040012' => '加盟店自由項目2が最大バイト数を超えています。',
        'M01040013' => '加盟店自由項目2に不正な文字が含まれています。',
        'M01041012' => '加盟店自由項目3が最大バイト数を超えています。',
        'M01041013' => '加盟店自由項目3に不正な文字が含まれています。',
        'M01042005' => '結果返却方法フラグが最大文字数を超えています。',
        'M01042011' => '結果返却方法フラグに”0”,”1”以外の値が指定されています。',
        'M01043001' => '商品・サービス名が指定されていません。',
        'M01043012' => '商品・サービス名が最大バイト数を超えています。',
        'M01043013' => '商品・サービス名に不正な文字が含まれています。',
        'M01044012' => '決済開始メール付加情報が最大バイト数を超えています。',
        'M01044013' => '決済開始メール付加情報に不正な文字が含まれています。',
        'M01045012' => '決済完了メール付加情報が最大バイト数を超えています。',
        'M01045013' => '決済完了メール付加情報に不正な文字が含まれています。',
        'M01046012' => '決済内容確認画面付加情報が最大バイト数を超えています。',
        'M01046013' => '決済内容確認画面付加情報に不正な文字が含まれています。',
        'M01047012' => '決済完了画面付加情報が最大バイト数を超えています。',
        'M01047013' => '決済完了画面付加情報に不正な文字が含まれています。',
        'M01048005' => '支払期限秒数が最大文字数を超えています。',
        'M01048006' => '支払期限秒数に数字以外の文字が指定されています。',
        'M01048011' => '支払期限秒数が有効な範囲ではありません。',
        'M01049012' => '決済開始メール付加情報が最大バイト数を超えています。',
        'M01049013' => '決済開始メール付加情報に不正な文字が含まれています。',
        'M01050012' => '決済完了メール付加情報が最大バイト数を超えています。',
        'M01050013' => '決済完了メール付加情報に不正な文字が含まれています。',
        'M01051001' => '決済方法が指定されていません。',
        'M01051005' => '決済方法が最大文字数を超えています。',
        'M01051011' => '決済方法が有効な範囲ではありません。',
        'M01052011' => '支払期限日を超えています。',
        'M01053002' => '指定されたコンビニはご利用できません。',
        'M01054001' => '処理区分が指定されていません。',
        'M01054004' => '取引の現状態に対して、処理可能な操作ではありません。',
        'M01054010' => '指定された処理区分は定義されていません。',
        'M01055010' => '取引の利用金額・税送料の合計値が、指定された利用金額・税送料の合計値と一致しません。',
        'M01055011' => '指定された利用金額・税送料の合計値が取引の利用金額・税送料の合計値を超えています。',
        'M01056001' => 'リダイレクトURLが指定されていません。',
        'M01056012' => 'リダイレクトURLが最大文字数を超えています。',
        'M01057010' => '取消可能な期間を超えています。',
        'M01058002' => '指定された取引が存在しません。',
        'M01058010' => '取引のショップIDが、指定されたショップIDと一致しません。',
        'M01059001' => '戻り先URLが設定されていません。',
        'M01059005' => '戻り先URLが最大文字数を超えています。',
        'M01059012' => '戻り先URLが最大文字数を超えています。',
        'M01060010' => '仮売上有効期間を超えています。',
        'M01061001' => '金融機関コードが設定されていません。',
        'M01061002' => '存在しない金融機関コードが設定されました。',
        'M01061005' => '金融機関コードが最大桁数を超えています。',
        'M01062001' => '支店コードが設定されていません。',
        'M01062002' => '存在しない支店コードが設定されました。',
        'M01062005' => '支店コードが最大桁数を超えています。',
        'M01063001' => '会員登録区分が設定されていません。',
        'M01063002' => '存在しない会員登録区分が設定されました。',
        'M01064001' => '口座名義人（姓：漢字）が設定されていません。',
        'M01064003' => '口座名義人（姓：漢字）が最大文字数を超えています。',
        'M01064013' => '口座名義人（姓：漢字）に利用できない文字が含まれています。',
        'M01065001' => '口座名義人（姓：読み）が設定されていません。',
        'M01065003' => '口座名義人（姓：読み）が最大文字数を超えています。',
        'M01065013' => '口座名義人（姓：読み）に利用できない文字が含まれています。',
        'M01066001' => '口座名義人（名：漢字）が設定されていません。',
        'M01066003' => '口座名義人（名：漢字）が最大文字数を超えています。',
        'M01066013' => '口座名義人（名：漢字）に利用できない文字が含まれています。',
        'M01067001' => '口座名義人（名：読み）が設定されていません。',
        'M01067003' => '口座名義人（名：読み）が最大文字数を超えています。',
        'M01067013' => '口座名義人（名：読み）に利用できない文字が含まれています。',
        'M01068001' => '口座名義人（法人名漢字）が設定されていません。',
        'M01068003' => '口座名義人（法人名漢字）が最大文字数を超えています。',
        'M01068013' => '口座名義人（法人名漢字）に利用できない文字が含まれています。',
        'M01069001' => '口座名義人（法人名読み）が設定されていません。',
        'M01069003' => '口座名義人（法人名読み）が最大文字数を超えています。',
        'M01069013' => '口座名義人（法人名読み）に利用できない文字が含まれています。',
        'M01070001' => '口座番号が設定されていません。',
        'M01070002' => '存在しない預金種目が設定されました。',
        'M01071001' => '口座番号が設定されていません。',
        'M01071005' => '口座番号が最大桁数を超えています。',
        'M01071006' => '口座番号に数字以外の文字が含まれています。',
        'M01073001' => 'トランザクションIDが設定されていません。',
        'M01073002' => '存在しないトランザクションIDが指定されました。',
        'M01073004' => '指定した申込処理は実行出来ません。',
        'M01074090' => 'トークンが不正です。',
        'M01075001' => '口座名義が設定されていません。',
        'M01075005' => '口座名義が最大文字数を超えています。',
        'M01075013' => '口座名義に利用できない文字が含まれています。',
        'M01076001' => 'ユーザ利用端末が設定されていません。',
        'M01076010' => '指定されたユーザ利用端末は定義されていません。',
        'M01077005' => '口座名義漢字が最大文字数を超えています。',
        'M01077013' => '口座名義漢字に利用できない文字が含まれています。',
        'M01078005' => '通貨コードの桁数が間違っています。',
        'M01078010' => '利用可能な通貨コードではありません。',
        'M01079010' => '利用可能なロケールではありません。',
        'M01080001' => '摘要が設定されていません。',
        'M01080005' => '摘要が最大文字数を超えています。',
        'M01080013' => '摘要に利用できない文字が含まれています。',
        'M01081011' => '決済結果URL有効期限秒が有効な範囲ではありません。',
        'M01081013' => '決済結果URL有効期限秒に利用できない文字が含まれています。',
        'M01082001' => 'サービス名が設定されていません。',
        'M01082005' => 'サービス名が最大文字数を超えています。',
        'M01082013' => 'サービス名に利用できない文字が含まれています。',
        'M01083001' => 'サービス電話番号が設定されていません。',
        'M01084002' => '存在しないOpenIDが指定されました。',
        'M01085001' => 'キャンセル金額が指定されていません。',
        'M01085005' => 'キャンセル金額が最大桁数を超えています。',
        'M01085006' => 'キャンセル金額に数字以外の文字が含まれています。',
        'M01085010' => 'オーソリ時の金額とキャンセル金額が一致しません。',
        'M01085011' => 'キャンセル金額がオーソリ時の金額を超えています。',
        'M01086005' => 'キャンセル税送料が最大桁数を超えています。',
        'M01086006' => 'キャンセル税送料に数字以外の文字が含まれています。',
        'M01087012' => 'ドコモ表示項目1が最大桁数を超えています。',
        'M01087013' => 'ドコモ表示項目1に利用できない文字が含まれています。',
        'M01088012' => 'ドコモ表示項目2が最大桁数を超えています。',
        'M01088013' => 'ドコモ表示項目2に利用できない文字が含まれています。',
        'M01089010' => '処理要求実施最終期限を超えています。',
        'M01500001' => 'ショップ情報文字列が設定されていません。',
        'M01500005' => 'ショップ情報文字列の文字数が間違っています。',
        'M01500012' => 'ショップ情報文字列が他の項目と矛盾しています。',
        'M01510001' => '購買情報文字列が設定されていません。',
        'M01510005' => '購買情報文字列の文字数が間違っています。',
        'M01510012' => '購買情報文字列が他の項目と矛盾しています。',
        'M01520002' => 'ユーザー利用端末情報に無効な値が設定されています。',
        'M01530001' => '決済結果戻り先URLが設定されていません。',
        'M01530005' => '決済結果戻り先URLが最大文字数を越えています。',
        'M01540005' => '決済キャンセル時URLが最大文字数を超えています。',
        'M01550001' => '日時情報文字列が設定されていません。',
        'M01550005' => '日時情報文字列の文字数が間違っています。',
        'M01550006' => '日時情報文字列に無効な文字が含まれます。',
        'M01590005' => '商品コードが最大桁数を超えています。',
        'M01590006' => '商品コードに無効な文字が含まれます。',
        'M01600001' => '会員情報チェック文字列が設定されていません。',
        'M01600005' => '会員情報チェック文字列が最大文字数を超えています。',
        'M01600012' => '会員情報チェック文字列が他の項目と矛盾しています。',
        'M01610005' => 'リトライ回数が0∼99の範囲外です。',
        'M01610006' => 'リトライ回数に数字以外が設定されています。',
        'M01620005' => 'セッションタイムアウト値が0∼9999の範囲外です。',
        'M01620006' => 'セッションタイムアウト値に数字以外が設定されています。',
        'M01630010' => '取引後カード登録時、取引の会員Dとパラメータの会員IDが一致しません。',
        'M01640010' => '取引後カード登録時、取引のサイトIDとパラメータのサイトIDが一致しません。',
        'M01650012' => '指定されたショップは、指定されたサイトに属していません。',
        'M01660013' => '言語パラメータにサポートされない値が設定されています。',
        'M01670013' => '出力エンコーディングにサポートされない値が設定されています。',
        'M01680001' => '決済利用フラグが設定されていません。',
        'M01680008' => '決済利用フラグに”0”,”1”以外の値が指定されています。',
        'M01700001' => 'メールリンクのご利用契約が無いか、利用停止中です。',
        'M01701002' => '呼び出したメールリンクデータは存在しません。',
        'M01702003' => '呼び出したメールリンクデータは有効期限切れです。',
        'M01703001' => 'ユニーク文字列が指定されていません。',
        'M01703005' => 'ユニーク文字列の長さが32バイト以外です。',
        'M01704005' => 'テンプレート番号が1桁を超えています。',
        'M01704006' => 'テンプレート番号に数字以外が設定されています。',
        'M11010099' => 'この取引は決済が終了していません。',
        'M11010999' => '特になし',
        'M91099999' => '決済処理に失敗しました。',
        '42G440000' => 'セキュリティーコードが誤っていた為に、決済を完了する事が出来ませんでした。',
        '42G450000' => 'セキュリティーコードが入力されていない為に、決済を完了する事が出来ませんでした。',
        'S01000002' => 'モバイルSuicaアプリのネット決済一覧から決済を行ってください',
        'S01001001' => '決済依頼処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'S01001002' => '決済依頼処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'S01001006' => 'モバイルSuica決済は利用できません。',
        'S01001007' => 'モバイルSuicaの登録が終わってから、再度購入画面からやり直してください。',
        'S01001008' => 'モバイルSuica決済の決済依頼件数がオーバーしています。モバイルSuicaアプリのネット決済一覧確認してから、再度購入画面からやり直してください。',
        'S01001010' => '決済処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'S01001015' => 'モバイルSuicaの登録状況を確認した後、再度購入画面からやり直してください。',
        'S01001016' => '決済処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'S01001017' => '決済処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してく',
        'S01009901' => '決済処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'S01009902' => '決済処理に失敗しました。申し訳ございませんが、しばらく時間をあけて購入画面からやり直してください。',
        'F01001001' => 'ショップIDが指定されていません。',
        'F01001008' => 'ショップIDに半角英数字以外の文字が含まれているか、13文字を超えています。',
        'F01002001' => 'ショップパスワードが指定されていません。',
        'F01002008' => 'ショップパスワードに半角英数字以外の文字が含まれているか、10文字を超えています。',
        'F01003002' => '指定されたIDのショップが存在しません。',
        'F01004001' => '照会IDが指定されていません。',
        'F01004002' => '指定されたIDの照会が存在しません。',
        'F01004005' => '照会IDが最大桁数を超えています。',
        'F01010001' => '住所（都道府県）が指定されていません。',
        'F01010012' => '住所（都道府県）が最大バイト数を超えています。',
        'F01011001' => '住所（市区町村）が指定されていません。',
        'F01011012' => '住所（市区町村）が最大バイト数を超えています。',
        'F01012001' => '住所（地名）が指定されていません。',
        'F01012012' => '住所（地名）が最大バイト数を超えています。',
        'F01013001' => '住所（番地・丁目）が指定されていません。',
        'F01013012' => '住所（番地・丁目）が最大バイト数を超えています。',
        'F01014012' => '住所（号室）が最大バイト数を超えています。',
        'F01015005' => '電話番号が最大文字数を超えています。',
        'F01015008' => '電話番号に数字、−以外の文字が指定されています。',
        'F01020008' => 'レコード区分にHD以外の値が指定されています。',
        'F01021008' => 'レコード区分にDT以外の値が指定されています。',
        'F01022008' => 'レコード区分にFT以外の値が指定されています。',
        'F01023008' => '項目数が誤っています。',
        'F01024008' => '項目数が誤っています。',
        'F01025008' => '項目数が誤っています。',
        'F01026008' => '項目数が誤っています。',
        'F01030001' => 'データレコード件数が指定されていません。',
        'F01030006' => 'データレコード件数に数字以外の文字が含まれています。',
        'F01030011' => 'データレコード件数が1∼20000の範囲ではありません。',
        'F01040010' => 'ヘッダレコードのレコード件数とデータレコードの件数が一致しません。',
        'F01050001' => '同一ショップ内で照会Ｉ／Ｆの照会実行中に照会データ登録が実行されました。',
        'F01060001' => '照会機能が利用停止になっています。',
        'F01070001' => '照会データが指定されていません。',
        'F01090999' => '照会実行中にエラーが発生しました。',
        'N01001001' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001002' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001003' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001004' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001005' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001006' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001007' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001008' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N01001009' => '実行中にエラーが発生しました。処理は開始されませんでした。',
        'N10000001' => '該当する取引がありません。',
        'N0C030C01' => 'しばらくしてからやり直してください。',
        'N0C030C03' => 'しばらくしてからやり直してください。',
        'N0C030C12' => 'しばらくしてからやり直してください。',
        'N0C030C13' => 'しばらくご利用になれません。',
        'N0C030C14' => 'しばらくしてからやり直してください。',
        'N0C030C15' => 'しばらくしてからやり直してください。',
        'N0C030C16' => 'しばらくしてからやり直してください。',
        'N0C030C33' => 'しばらくしてからやり直してください。',
        'N0C030C34' => 'しばらくしてからやり直してください。',
        'N0C030C49' => 'しばらくしてからやり直してください。',
        'N0C030C50' => 'しばらくしてからやり直してください。',
        'N0C030C51' => 'もう一度やり直してください。',
        'N0C030C53' => 'しばらくしてからやり直してください。',
        'N0C030C54' => 'しばらくしてからやり直してください。',
        'N0C030C55' => 'しばらくしてからやり直してください。',
        'N0C030C56' => 'しばらくしてからやり直してください。',
        'N0C030C57' => 'しばらくしてからやり直してください。',
        'N0C030C58' => 'しばらくしてからやり直してください。',
        'N0C030C60' => 'しばらくしてからやり直してください。',
        'N0C030G03' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G12' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G30' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G54' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G55' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G56' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G60' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G61' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G65' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G67' => 'しばらくしてからやり直してください。',
        'N0C030G83' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G85' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G95' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G96' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G97' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0C030G98' => 'もう一度やり直してください。',
        'N0C030G99' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N010007' => 'お客様の携帯電話ではサービスをご利用いただけません。',
        'N0N010008' => 'お客様の携帯電話ではサービスをご利用いただけません。',
        'N0N010009' => 'お客様の携帯電話ではサービスをご利用いただけません。',
        'N0N010013' => 'しばらくご利用になれません。店舗までお問合せください。',
        'N0N010024' => 'しばらくご利用になれません。店舗までお問合せください。',
        'N0N010032' => 'しばらくご利用になれません。店舗までお問合せください。',
        'N0N020014' => 'エラーが発生しました。店舗までお問合せください。',
        'N0N020017' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020018' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020019' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020020' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020021' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020022' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N020023' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N030038' => '暗証番号が誤っていますので、現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0N040014' => 'エラーが発生しました。店舗までお問合せください。',
        'N0K040026' => 'もう一度やり直してください。',
        'N0K040027' => 'エラーが発生しました。店舗までお問合せください。',
        'N0K040028' => 'エラーが発生しました。店舗までお問合せください。',
        'N0K040029' => 'エラーが発生しました。店舗までお問合せください。',
        'N0N040031' => 'しばらくご利用になれません。店舗までお問合せください。',
        'N0K040037' => 'しばらくご利用になれません。店舗までお問合せください。',
        'N0T000001' => 'もう一度やり直してください。',
        'N0T000002' => 'ご利用可能なカードが設定されていないため、お支払を継続できません。なお、iDでお支払いただくには事前にカードを設定いただく必要がありますｊ。',
        'N0T000003' => 'ご利用可能なカードが設定されていないため、お支払を継続できません。なお、iDでお支払いただくには事前にカードを設定いただく必要がありますｊ。',
        'N0T000004' => 'パスワード入力間違いが規定回数を超えたため、iDでのお支払を継続できません。なお、iDを再度ご利用いただくには、iDアプリを再度起動しリセットを実行した後、カードを設定しなおしていただく必要があります。',
        'N0T000005' => 'ICカードロックを設定されている場合は、一旦iDアプリを終了し、ICカードロックを解除してから再度iDアプリを起動してください。ICカードロックを解除してもご利用いただけない場合はカード会社へお問合せください。',
        'N0T000006' => 'エラーが発生しました。店舗までお問合せください。',
        'N0T000009' => '現在このカードはお取扱できません。カード会社にお問合せください。',
        'N0T000007' => 'もう一度やり直してください。',
        'N0T000008' => 'もう一度やり直してください。',
        'N0T000010' => 'もう一度やり直してください。',
    ];

    public static function getDescription($code)
    {
        foreach ([
            self::ERROR_CODE_TO_DESCRIPTION_MAP_ENGLISH,
            self::ERROR_CODE_TO_DESCRIPTION_MAP_JAPANESE
        ] as $errors) {
            if (isset($errors[$code])) {
                return $errors[$code];
            }
        }

        return 'An unknown error occurred.'; // 原因不明のエラーが発生しました。
    }
}
