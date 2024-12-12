import { Injectable } from '@angular/core';
import jsonData from '../data/data.json';
import { FormControl, FormGroup } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';

@Injectable()
export class nurseService {
    nurses: Nurse[] = jsonData;
    constructor(private _router: Router,
        private _activRoute: ActivatedRoute) { }

    form = new FormGroup({
        gmail: new FormControl(''),
        pwd: new FormControl('')
    });
    login() {
        let value = this.form.value;

        console.log('Form values:', value); // Muestra los valores ingresados
        console.log('Nurses array:', this.nurses); // Muestra los datos cargados

        const nurse = this.nurses.find(
            (n) =>
                n.gmail.toLowerCase() === value.gmail?.trim().toLowerCase() &&
                n.pwd === value.pwd?.trim()
        );

        if (nurse) {
            alert(`Welcome, ${nurse.name}!`);
            this._router.navigate(['/findOne']);
            this._router.navigate(['/getAll']);
        } else {
            alert('Invalid Gmail or Password');
        }
    }
}
class Nurse {
    id: string = '';
    name: string = '';
    pwd: string = '';
    gmail: string = '';
}