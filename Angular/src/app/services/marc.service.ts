import { Injectable, ViewChild, ElementRef } from '@angular/core';
import jsonData from '../data/data.json';
import { FormControl, FormGroup } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { Component } from '@angular/core';

@Injectable()
export class nurseService {
   
}

class Nurse {
    id: string = '';
    name: string = '';
    pwd: string = '';
    gmail: string = '';
}

