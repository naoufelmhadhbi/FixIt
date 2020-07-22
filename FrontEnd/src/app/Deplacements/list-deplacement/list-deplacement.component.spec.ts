import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListDeplacementComponent } from './list-deplacement.component';

describe('ListDeplacementComponent', () => {
  let component: ListDeplacementComponent;
  let fixture: ComponentFixture<ListDeplacementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListDeplacementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListDeplacementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
