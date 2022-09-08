<?php

namespace App\Enums;

enum Role: string {
	case User = 'USER';
	case Editor = 'EDITOR';
	case Admin = 'ADMIN';
}
