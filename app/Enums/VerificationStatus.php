<?php
    namespace App\Enums;

    enum VerificationStatus: string
    {
        case Pending = "pending";
        case NeedMoreInfo = 'need more info';
        case Verified = "verified";

    }