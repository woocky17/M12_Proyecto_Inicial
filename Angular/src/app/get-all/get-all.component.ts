import { Component } from '@angular/core';
import jsonData from '../data/data.json';

@Component({
  selector: 'app-get-all',
  templateUrl: './get-all.component.html',
  styleUrl: './get-all.component.css'
})
export class GetAllComponent {
  nurses: Nurse[] = jsonData;



}

class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
} 