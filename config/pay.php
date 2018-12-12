<?php

return [
    'alipay' => [
        'app_id'         => '2016091300504126',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAoAAbBVtpw8ZwdnEuTxUgHoMFHEms7u9kCHNdXNgyq8/GZHcZoutTquoQMwuJ3pqIBqpXeVL/iOd7eDyXCw+0ViXMwC4rtlywedUtvr9vkUjLlH6NIc8IZEROrRidXLSYWodHINH7qG9GJHkXANrvtVF47KHJmoN59v3riX54ibnv+nRxdnx+tgOGC1Tmu478wcrRAv4hVvkH6sR25oT8kIRofA/VjcVNGB27RRdj6GTJmmCYnW9C4InTyZurh0wZdQPpX/ZsoJ2MJFbQotlCIezOUG4mjS7RTdUuIB6JL+GmbON3/2TXVOD9WFnm3mX6oz2NOJYQhUxwaSt5o+dldwIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEA2yVafaZzQd3HfwsviuI7RPMDec+jPBnpjuX1oCa1fvXdbx8iERLj4nfoOBVYz/aTMzRlxHUluRFxdE3Y3Vuzb1XwnYrVqdBqL5s7fQvuhaP9UG/LykhiG3e2xKhmmpjiJ4O7fDymEFq6TZQlZ4laoIcqIsf5L5BuIqaV3JHDi49frX4ebb3A4BEOYPXX+uyRaFKMy0YN9X3jcHLePao3dWlRzeVbnousOkiogvhdOiWNmmGyYG6dHiVYO4hMHqFEQkiuZA3wTYgZONs26qIBPOCKE/mBVpfYq5iLj1CI0dZ8oBVYYDU8C5Ti35n2qpv611sbhf36asgcHryTKFhyCwIDAQABAoIBACWOBi7oOnI8LnbwFMqpMF0FhD/4vFGNY0AQ2oICgDHssnDblfv1D8Z8o/gQeHLTH7CztwjuxnMrsRSsTpDIqTxYLu7gnvMF+1yDLrOkOtD+JGgHcJYOx3lLj6+t6D9wGbmJ0rRctFyzH6Ax1iMjH7vIzgi92k8zYhxgDeiJtkgRDaxZgqbGeaUMCnr7vOObUMTCnlLzwtmy7otYEtDPbMxVSubyk0yWOpb4wJbWfReA96r3fNav4CVpvOeEhegmY/wSXulcFoKsLFLvuD0308eqcvLsqCU3t2kJTKc0Lfev2nb2rtKyhFyHIBwXxA76Tf0hSWu7baB4MCrfNoT/bLECgYEA9JWZj2DgaW5qLLMsGl8KPDR3kkUAEXBWH8T6yWtRdLhQ8S7yyoZTMS1hRsATALOZaulqQUl1hGY8vMpsbtuH2MJvKQXxBcoqS32qRGksOT7oOrNFzvCt8VPIIg878eTI13umul8qvy22XY4OhxxkawuHioaMDdD5xQKi5ykzVGkCgYEA5V/NyZoGeasw9LYaV+TdsnOIfCoASWTccn5vza8f2lYEuT0axRWKrAe+nQMsY6kIkHgL2Mx3Ph3qJmN338y5FtTuiZc2Se88LreoOXzggMWvrJjOnXQGvyPT1pqd1CGNVXs0qCOFRymxpcW0vDHqZ5PcWjNT5XIgM7WQX9ZA9FMCgYBkfOpgfB73ckPxJZQjKZUc8zmFQRAsGgloeBfJlWwcFnY7AV0DVHjtpYVn+hZUnXWU9V2QgUvlH9QohMpUKaIArrHZGvXRuSPzbCf+f2+J/YyQQYOW6E+u7Qs24ydv1N2nmsf/noYDkhZxDaJuZH3ldRE1Gt6D9q4IAXNIoibSsQKBgQCnVMbJpeXHaM3kF90L9diN0J7nBbUD1eLEW9ywTmuMWmhDwoH++QIbEeNKpAAEDFJFIm5yEGeFF0m0C6htyenU8C28jmV6dl6PLkg4+BLHnm/UF/3S+8vYMQjfbBhrorZ6f9EgQBmAmrgQWTTKfhekzEdaPkub/S/kyTWz1Je6JQKBgE+Vq9OZXYCwYb4mnZuBfVOZEHbN7u+yQghH56+hTT83hZx3hrLR0FTqQNx8kYSrNIRsLyugwFxudLN+mnMf2hyXA/7x8XUsPpeu8DfOXrVrudoAza2qdOsBWqQxib55FwUv1AoNIv8gt4IQKpJ+9/BR+eroB7EyDBKXj2LMo4lK',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => 'wxa10ac71a8741474e',
        'mch_id'      => '1405516602',
        'key'         => '8YC6kgrvCL4IN7w4UYwsknsGVbP1Xxje',
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];