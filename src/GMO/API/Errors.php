<?php
/*
 * Copyright © 2015-2017 Alexey Kopytko.
 * Distributed under the MIT License.
 */

namespace GMO\API;

/**
 * Common error codes.
 *
 * For a list of most known codes see:
 * https://github.com/fumikito/Literally-WordPress/blob/master/class/payment/gmo_error_handler.php
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
}
