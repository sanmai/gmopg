<?php
/*
 * Copyright © 2015 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API;

final class MethodsActual extends MethodsAbstract
{
    // カード

    /** 取引登録 */
    const EntryTran = "https://p01.mul-pay.jp/payment/EntryTran.idPass";
    /** 決済実行 */
    const ExecTran = "https://p01.mul-pay.jp/payment/ExecTran.idPass";
    /** 3D認証決済実行 */
    const SecureTran = "https://p01.mul-pay.jp/payment/SecureTran.idPass";
    /** 決済変更 */
    const AlterTran = "https://p01.mul-pay.jp/payment/AlterTran.idPass";
    /** 金額変更 */
    const ChangeTran = "https://p01.mul-pay.jp/payment/ChangeTran.idPass";
    /** 取引照会 */
    const SearchTrade = "https://p01.mul-pay.jp/payment/SearchTrade.idPass";

    // 会員ID

    /** 決済後カード登録 */
    const TradedCard = "https://p01.mul-pay.jp/payment/TradedCard.idPass";
    /** 会員登録 */
    const SaveMember = "https://p01.mul-pay.jp/payment/SaveMember.idPass";
    /** 会員更新 */
    const UpdateMember = "https://p01.mul-pay.jp/payment/UpdateMember.idPass";
    /** 会員照会 */
    const SearchMember = "https://p01.mul-pay.jp/payment/SearchMember.idPass";
    /** 会員削除 */
    const DeleteMember = "https://p01.mul-pay.jp/payment/DeleteMember.idPass";
    /** カード登録／更新 */
    const SaveCard = "https://p01.mul-pay.jp/payment/SaveCard.idPass";
    /** カード照会 */
    const SearchCard = "https://p01.mul-pay.jp/payment/SearchCard.idPass";
    /** カード削除 */
    const DeleteCard = "https://p01.mul-pay.jp/payment/DeleteCard.idPass";



    // コンビニ

    /** 取引登録 */
    const EntryTranCvs = "https://p01.mul-pay.jp/payment/EntryTranCvs.idPass";
    /** 決済実行 */
    const ExecTranCvs = "https://p01.mul-pay.jp/payment/ExecTranCvs.idPass";


    // モバイルSuica

    /** 取引登録 */
    const EntryTranSuica = "https://p01.mul-pay.jp/payment/EntryTranSuica.idPass";
    /** 決済実行 */
    const ExecTranSuica = "https://p01.mul-pay.jp/payment/ExecTranSuica.idPass";


    // 楽天Edy

    /** 取引登録 */
    const EntryTranEdy = "https://p01.mul-pay.jp/payment/EntryTranEdy.idPass";
    /** 決済実行 */
    const ExecTranEdy = "https://p01.mul-pay.jp/payment/ExecTranEdy.idPass";


    // Pay-easy

    /** 取引登録 */
    const EntryTranPayEasy = "https://p01.mul-pay.jp/payment/EntryTranPayEasy.idPass";
    /** 決済実行 */
    const ExecTranPayEasy = "https://p01.mul-pay.jp/payment/ExecTranPayEasy.idPass";


    // PayPal

    /** 取引登録 */
    const EntryTranPaypal = "https://p01.mul-pay.jp/payment/EntryTranPaypal.idPass";
    /** 決済実行 */
    const ExecTranPaypal = "https://p01.mul-pay.jp/payment/ExecTranPaypal.idPass";
    /** 支払手続き開始 */
    const PaypalStart = "https://p01.mul-pay.jp/payment/PaypalStart.idPass";
    /** 決済取消 */
    const CancelTranPaypal = "https://p01.mul-pay.jp/payment/CancelTranPaypal.idPass";


    // iD

    /** 取引登録 */
    const EntryTranNetid = "https://p01.mul-pay.jp/payment/EntryTranNetid.idPass";
    /** 決済実行 */
    const ExecTranNetid = "https://p01.mul-pay.jp/payment/ExecTranNetid.idPass";
    /** iD決済開始ページ */
    const NetidStart = "https://p01.mul-pay.jp/payment/NetidStart.idPass";
    /** 実売上 */
    const SalesTranNetid = "https://p01.mul-pay.jp/payment/SalesTranNetid.idPass";
    /** キャンセル */
    const CancelTranNetid = "https://p01.mul-pay.jp/payment/CancelTranNetid.idPass";
    /** 金額変更 */
    const ChangeTranNetid = "https://p01.mul-pay.jp/payment/ChangeTranNetid.idPass";


    // WebMoney

    /** 取引登録 */
    const EntryTranWebmoney = "https://p01.mul-pay.jp/payment/EntryTranWebmoney.idPass";
    /** 決済実行 */
    const ExecTranWebmoney = "https://p01.mul-pay.jp/payment/ExecTranWebmoney.idPass";
    /** 支払手続き開始 */
    const WebmoneyStart = "https://p01.mul-pay.jp/payment/WebmoneyStart.idPass";


    // au

    /** 取引登録 */
    const EntryTranAu = "https://p01.mul-pay.jp/payment/EntryTranAu.idPass";
    /** 決済実行 */
    const ExecTranAu = "https://p01.mul-pay.jp/payment/ExecTranAu.idPass";
    /** 実売上 */
    const AuSales = "https://p01.mul-pay.jp/payment/AuSales.idPass";
    /** キャンセル・返品連携 */
    const AuCancelReturn = "https://p01.mul-pay.jp/payment/AuCancelReturn.idPass";
    /** OpenID解除 */
    const DeleteAuOpenID = "https://p01.mul-pay.jp/payment/DeleteAuOpenID.idPass";


    // docomo

    /** 取引登録 */
    const EntryTranDocomo = "https://p01.mul-pay.jp/payment/EntryTranDocomo.idPass";
    /** 決済実行 */
    const ExecTranDocomo = "https://p01.mul-pay.jp/payment/ExecTranDocomo.idPass";
    /** 支払手続き開始 */
    const DocomoStart = "https://p01.mul-pay.jp/payment/DocomoStart.idPass";
    /** キャンセル */
    const DocomoCancelReturn = "https://p01.mul-pay.jp/payment/DocomoCancelReturn.idPass";
    /** 実売上 */
    const DocomoSales = "https://p01.mul-pay.jp/payment/DocomoSales.idPass";


    // ソフトバンク

    /** 取引登録 */
    const EntryTranSb = "https://p01.mul-pay.jp/payment/EntryTranSb.idPass";
    /** 決済実行 */
    const ExecTranSb = "https://p01.mul-pay.jp/payment/ExecTranSb.idPass";
    /** 支払手続き開始 */
    const SbStart = "https://p01.mul-pay.jp/payment/SbStart.idPass";
    /** キャンセル */
    const SbCancel = "https://p01.mul-pay.jp/payment/SbCancel.idPass";
    /** 実売上 */
    const SbSales = "https://p01.mul-pay.jp/payment/SbSales.idPass";


    // auかんたん継続

    /** 取引登録 */
    const EntryTranAuContinuance = "https://p01.mul-pay.jp/payment/EntryTranAuContinuance.idPass";
    /** 決済実行 */
    const ExecTranAuContinuance = "https://p01.mul-pay.jp/payment/ExecTranAuContinuance.idPass";
    /** 取引開始 */
    const AuContinuanceStart = "https://p01.mul-pay.jp/payment/AuContinuanceStart.idPass";
    /** 取引キャンセル */
    const AuContinuanceCancel = "https://p01.mul-pay.jp/payment/AuContinuanceCancel.idPass";
    /** 売上取消・返金 */
    const AuChargeCancel = "https://p01.mul-pay.jp/payment/AuChargeCancel.idPass";


    // docomo継続

    /** 取引登録 */
    const EntryTranDocomoContinuance = "https://p01.mul-pay.jp/payment/EntryTranDocomoContinuance.idPass";
    /** 決済実行 */
    const ExecTranDocomoContinuance = "https://p01.mul-pay.jp/payment/ExecTranDocomoContinuance.idPass";
    /** 支払手続き開始 */
    const DocomoContinuanceStart = "https://p01.mul-pay.jp/payment/DocomoContinuanceStart.idPass";
    /** キャンセル */
    const DocomoContinuanceCancelReturn = "https://p01.mul-pay.jp/payment/DocomoContinuanceCancelReturn.idPass";
    /** 実売上 */
    const DocomoContinuanceSales = "https://p01.mul-pay.jp/payment/DocomoContinuanceSales.idPass";
    /** 加盟店金額変更 */
    const DocomoContinuanceShopChange = "https://p01.mul-pay.jp/payment/DocomoContinuanceShopChange.idPass";
    /** お客様金額変更 */
    const DocomoContinuanceUserChange = "https://p01.mul-pay.jp/payment/DocomoContinuanceUserChange.idPass";
    /** お客様金額変更開始 */
    const DocomoContinuanceUserChangeStart = "https://p01.mul-pay.jp/payment/DocomoContinuanceUserChangeStart.idPass";
    /** 加盟店課金終了 */
    const DocomoContinuanceShopEnd = "https://p01.mul-pay.jp/payment/DocomoContinuanceShopEnd.idPass";
    /** お客様課金終了 */
    const DocomoContinuanceUserEnd = "https://p01.mul-pay.jp/payment/DocomoContinuanceUserEnd.idPass";
    /** お客様課金終了開始 */
    const DocomoContinuanceUserEndStart = "https://p01.mul-pay.jp/payment/DocomoContinuanceUserEndStart.idPass";


    // じぶん銀行

    /** 取引登録 */
    const EntryTranJibun = "https://p01.mul-pay.jp/payment/EntryTranJibun.idPass";
    /** 決済実行 */
    const ExecTranJibun = "https://p01.mul-pay.jp/payment/ExecTranJibun.idPass";
    /** 支払手続き開始 */
    const JibunStart = "https://p01.mul-pay.jp/payment/JibunStart.idPass";


    // JCB PREMO

    /** 取引登録 */
    const EntryTranJcbPreca = "https://p01.mul-pay.jp/payment/EntryTranJcbPreca.idPass";
    /** 決済実行 */
    const ExecTranJcbPreca = "https://p01.mul-pay.jp/payment/ExecTranJcbPreca.idPass";
    /** 残高照会 */
    const JcbPrecaBalanceInquiry = "https://p01.mul-pay.jp/payment/JcbPrecaBalanceInquiry.idPass";
    /** キャンセル */
    const JcbPrecaCancel = "https://p01.mul-pay.jp/payment/JcbPrecaCancel.idPass";


    // フレッツまとめて支払い

    /** 取引登録 */
    const EntryTranFlets = "https://p01.mul-pay.jp/payment/EntryTranFlets.idPass";
    /** 決済実行 */
    const ExecTranFlets = "https://p01.mul-pay.jp/payment/ExecTranFlets.idPass";
    /** 支払手続き開始 */
    const FletsStart = "https://p01.mul-pay.jp/payment/FletsStart.idPass";
    /** キャンセル */
    const FletsCancel = "https://p01.mul-pay.jp/payment/FletsCancel.idPass";
    /** 実売上 */
    const FletsSales = "https://p01.mul-pay.jp/payment/FletsSales.idPass";


    // NET CASH・nanacoギフト

    /** 取引登録 */
    const EntryTranNetcash = "https://p01.mul-pay.jp/payment/EntryTranNetcash.idPass";
    /** 決済実行 */
    const ExecTranNetcash = "https://p01.mul-pay.jp/payment/ExecTranNetcash.idPass";
    /** 支払手続き開始 */
    const NetCashStart = "https://p01.mul-pay.jp/payment/NetCashStart.idPass";


    // 楽天ID

    /** 取引登録 */
    const EntryTranRakutenId = "https://p01.mul-pay.jp/payment/EntryTranRakutenId.idPass";
    /** 決済実行 */
    const ExecTranRakutenId = "https://p01.mul-pay.jp/payment/ExecTranRakutenId.idPass";
    /** 支払手続き開始 */
    const RakutenIdStart = "https://p01.mul-pay.jp/payment/RakutenIdStart.idPass";
    /** 実売上 */
    const RakutenIdSales = "https://p01.mul-pay.jp/payment/RakutenIdSales.idPass";
    /** キャンセル */
    const RakutenIdCancel = "https://p01.mul-pay.jp/payment/RakutenIdCancel.idPass";
    /** 金額変更 */
    const RakutenIdChange = "https://p01.mul-pay.jp/payment/RakutenIdChange.idPass";


    // 多通貨クレジットカード

    /** 取引登録 */
    const EntryTranMcp = "https://p01.mul-pay.jp/payment/EntryTranMcp.idPass";
    /** 決済実行 */
    const ExecTranMcp = "https://p01.mul-pay.jp/payment/ExecTranMcp.idPass";
    /** 支払手続き開始 */
    const McpStart = "https://p01.mul-pay.jp/payment/McpStart.idPass";
    /** 3D認証決済実行 */
    const SecureTranMcp = "https://p01.mul-pay.jp/payment/SecureTranMcp.idPass";
    /** 実売上 */
    const McpSales = "https://p01.mul-pay.jp/payment/McpSales.idPass";
    /** キャンセル */
    const McpCancel = "https://p01.mul-pay.jp/payment/McpCancel.idPass";


    // LINE Pay

    /** 取引登録 */
    const EntryTranLinepay = "https://p01.mul-pay.jp/payment/EntryTranLinepay.idPass";
    /** 決済実行 */
    const ExecTranLinepay = "https://p01.mul-pay.jp/payment/ExecTranLinepay.idPass";
    /** 支払手続き開始 */
    const LinepayStart = "https://p01.mul-pay.jp/payment/LinepayStart.idPass";
    /** 実売上 */
    const LinepaySales = "https://p01.mul-pay.jp/payment/LinepaySales.idPass";
    /** キャンセル */
    const LinepayCancelReturn = "https://p01.mul-pay.jp/payment/LinepayCancelReturn.idPass";


    // ネット銀聯

    /** 取引登録 */
    const EntryTranUnionpay = "https://p01.mul-pay.jp/payment/EntryTranUnionpay.idPass";
    /** 決済実行 */
    const ExecTranUnionpay = "https://p01.mul-pay.jp/payment/ExecTranUnionpay.idPass";
    /** 支払手続き開始 */
    const UnionpayStart = "https://p01.mul-pay.jp/payment/UnionpayStart.idPass";
    /** 実売上 */
    const UnionpaySales = "https://p01.mul-pay.jp/payment/UnionpaySales.idPass";
    /** キャンセル */
    const UnionpayCancel = "https://p01.mul-pay.jp/payment/UnionpayCancel.idPass";
    /** 返品 */
    const UnionpayReturn = "https://p01.mul-pay.jp/payment/UnionpayReturn.idPass";


    // マルチ

    /** 取引照会 */
    const SearchTradeMulti = "https://p01.mul-pay.jp/payment/SearchTradeMulti.idPass";


    // 不正住所検知

    /** 照会データ登録 */
    const EntryInquiryData = "https://p01.mul-pay.jp/payment/EntryInquiryData.idPass";
    /** 照会結果取得 */
    const GetInquiryResult = "https://p01.mul-pay.jp/payment/GetInquiryResult.idPass";
    /** 単発照会 */
    const SearchNac = "https://p01.mul-pay.jp/payment/SearchNac.idPass";

    const Example = "http://www.example.com/";
}
