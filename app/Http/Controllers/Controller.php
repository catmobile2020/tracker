<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @SWG\Swagger(
 * 		basePath="/api",
 * 		@SWG\Info(
 * 			title="Adaption Tracker",
 * 			version="1.0.0",
 *      @SWG\Contact(
 *             email="m.mohamed@cat.com.eg"
 *         ),
 * 		),
 * 		@SWG\SecurityScheme(
 * 			securityDefinition="jwt",
 * 			description="Value: Bearer \<token\><br><br>",
 * 			type="apiKey",
 * 			name="Authorization",
 * 			in="header",
 * 		),
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
